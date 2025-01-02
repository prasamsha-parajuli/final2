<?php
session_start();
require 'config.php';
$error = [];

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $pass = $_POST['password'];

    if (empty($email) || empty($pass)) {
        $error[] = 'All fields are required';
    } else {
        $stmt = $conn->prepare("SELECT * FROM user_form WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Debugging: Print the hashed password and the input password
            echo "Hashed Password: " . $user['password'] . "<br>";
            echo "Input Password: " . $pass . "<br>";

            if (password_verify($pass, $user['password'])) {
                $_SESSION['user_name'] = $user['name'];
                if ($user['user_type'] === 'admin') {
                    $_SESSION['admin_name'] = $user['name'];
                    header('Location: admin.php');
                } else {
                    header('Location: user_page.php');
                }
                exit();
            } else {
                $error[] = 'Incorrect password';
            }
        } else {
            $error[] = 'No user found with this email';
        }
    }
}
?>