<?php
session_start();
require 'config.php';

$generalError = '';
$name = $email = $phone = $address = '';
$fieldsRequired = ['name', 'email', 'password', 'cpassword', 'pnumber', 'address'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $phone = $_POST['pnumber'];
    $address = $_POST['address'];

    // Check if all fields are filled
    $emptyFields = [];
    foreach ($fieldsRequired as $field) {
        if (empty($_POST[$field])) {
            $emptyFields[] = $field;
        }
    }

    // If there are empty fields, show a general error message
    if (!empty($emptyFields)) {
        $generalError = 'All fields are required! Missing: ' . implode(', ', $emptyFields);
    } else {
       
        if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
            $generalError = 'Name should only contain letters!';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $generalError = 'Invalid Email format!';
        } elseif (!preg_match("/^\d{10}$/", $phone)) {
            $generalError = 'Phone number must be 10 digits!';
        } elseif (strlen($pass) < 8) {
            $generalError = 'Password must be at least 8 characters long!';
        } elseif ($pass != $cpass) {
            $generalError = 'Passwords do not match!';
        } else {
            // Check if the email already exists
            $stmt = $conn->prepare("SELECT * FROM user_form WHERE email=?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $generalError = 'User already exists!';
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
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/5fce70dfef.js" crossorigin="anonymous"></script>
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
        <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="cpassword" placeholder="Confirm Password">
        <input type="tel" name="pnumber" placeholder="Phone number" value="<?php echo htmlspecialchars($phone); ?>">
        <input name="address" placeholder="Your Address" value="<?php echo htmlspecialchars($address); ?>">
        <input type="submit" name="submit" value="Register" class="form-btn">
        <p>Already have an account?<a href="login_form.php">Login</a></p>
    </form>
</div>
</body>
</html>
