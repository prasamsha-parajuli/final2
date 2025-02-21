<?php
session_start();
include 'config.php';

$generalError = []; // Array to store error messages
$email = ""; // Initialize email/username for pre-filling the form

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $identifier = mysqli_real_escape_string($conn, $_POST['email']);
        $password = $_POST['password'];

        $query = "SELECT * FROM user_form WHERE email = '$identifier' OR name = '$identifier'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_address'] = $user['address']; // Storing address in session

                // Redirect to return URL or index.php
                $return_url = isset($_GET['return_url']) ? $_GET['return_url'] : 'index.php';
                header("Location: $return_url");
                exit();
            } else {
                $generalError[] = "Invalid email/username or password!";
            }
        } else {
            $generalError[] = "Invalid email/username or password!";
        }
    } else {
        $generalError[] = "Please provide both email/username and password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="signin.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="form-container">
    <form action="" method="POST">
        <h3>Login Form</h3>
        <?php if (!empty($generalError)) { ?>
            <?php foreach ($generalError as $error) { ?>
                <span class="error_msg"><?php echo $error; ?></span>
            <?php } ?>
        <?php } ?>
        <input type="text" name="email" placeholder="Email or Name" value="<?php echo htmlspecialchars($email); ?>" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" name="submit" value="Login" class="form-btn">
        <p>Don't have an account? <a href="signin.php">Register</a></p>
    </form>
</div>
</body>
</html>
