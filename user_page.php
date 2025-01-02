<?php 
session_start();
include 'config.php';
if(!isset($_SESSION['user_name'])){
    header('location:login_form.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="regstyle.css">
     <!--font awesome cdn link for icons-->
     <script src="https://kit.fontawesome.com/5fce70dfef.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>User Panel</title>
</head>
<body>
    <div class="container">
    <div class="content">
        <h3>hi, <span>User</span></h3>
            <h1>Welcome<span><?php echo $_SESSION['user_name']?></span></h1>
            <p>This is an user page</p>
            <a href="login_form.php" class="btn">Login</a>
            <a href="signin.php" class="btn">Register</a>
            <a href="logout.php" class="btn">Logout</a>
</div>
</div>


</body>
</html>