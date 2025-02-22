<?php
session_start();
require 'config.php';
$nameError = [];
$emailError = [];
$phoneError = [];
$passwordError = [];
$confirmPasswordError = [];
$addressError = [];
$generalError = '';
$name = $email = $phone = $address = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $phone = $_POST['pnumber'];
    $address = $_POST['address'];

    // server side validation
    if (empty($name)) {
        $nameError[] = 'Name is required!';
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $nameError[] = 'Name should only contain letters!';
    }
    if (empty($email)) {
        $emailError[] = 'Email is required!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError[] = 'Invalid Email format!';
    }
    if (empty($phone)) {
        $phoneError[] = 'Phone number is required!';
    } elseif (!preg_match("/^\d{10}$/", $phone)) { // Validate phone number (10 digits)
        $phoneError[] = 'Phone number must be 10 digits!';
    }
    if (empty($pass)) {
        $passwordError[] = 'Password is required!';
    }
    if (empty($cpass)) {
        $confirmPasswordError[] = 'Password is required!';
    } elseif ($pass != $cpass) {
        $confirmPasswordError[] = 'Passwords do not match!';
    }
    if (empty($address)) {
        $addressError[] = 'Address is required!';
    }

    if (empty($nameError) && empty($emailError) && empty($phoneError) && empty($passwordError) && empty($confirmPasswordError) && empty($addressError)) {
        // Check if the email already exists
        $stmt = $conn->prepare("SELECT * FROM user_form WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $emailError[] = 'User already exists!';
        } else {
            // Insert new user
            $hashedPass = password_hash($pass, PASSWORD_BCRYPT);
            $user_type = 'user';
            $stmt = $conn->prepare("INSERT INTO user_form (name, email, password, user_type, phone, address) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $name, $email, $hashedPass, $user_type, $phone, $address);
            if ($stmt->execute()) {
                header('location:login_form.php');
                exit();
            } else {
                $generalError = 'Registration Failed, Please try again later.'. $stmt->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="signin.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="form-container">
    <form action="" method="POST">
        <h3>Registration Form</h3>
        <?php if (!empty($generalError)) { ?>
            <span class="error_msg"><?php echo $generalError; ?></span>
        <?php } ?>
        <input type="text" name="name" placeholder="Full Name" value="<?php echo htmlspecialchars($name); ?>">
        <?php if (!empty($nameError)) { ?>
            <span class="error_msg"><?php echo implode('<br>', $nameError); ?></span>
        <?php } ?>
        <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
        <?php if (!empty($emailError)) { ?>
            <span class="error_msg"><?php echo implode('<br>', $emailError); ?></span>
        <?php } ?>
        <input type="password" name="password" placeholder="Password">
        <?php if (!empty($passwordError)) { ?>
            <span class="error_msg"><?php echo implode('<br>', $passwordError); ?></span>
        <?php } ?>
        <input type="password" name="cpassword" placeholder="Confirm Password">
        <?php if (!empty($confirmPasswordError)) { ?>
            <span class="error_msg"><?php echo implode('<br>', $confirmPasswordError); ?></span>
        <?php } ?>
        <input type="tel" name="pnumber" placeholder="Phone number" value="<?php echo htmlspecialchars($phone); ?>">
        <?php if (!empty($phoneError)) { ?>
            <span class="error_msg"><?php echo implode('<br>', $phoneError); ?></span>
        <?php } ?>
        <input name="address" placeholder="Your Address" value="<?php echo htmlspecialchars($address); ?>">
        <?php if (!empty($addressError)) { ?>
            <span class="error_msg"><?php echo implode('<br>', $addressError); ?></span>
        <?php } ?>
        <input type="submit" name="submit" value="Register" class="form-btn">
        <p>Already have an account?<a href="login_form.php">Login</a></p>
    </form>
</div>
</body>
</html>
