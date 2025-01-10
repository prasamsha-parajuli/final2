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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="admin.css">
     <!--font awesome cdn link for icons-->
     <script src="https://kit.fontawesome.com/5fce70dfef.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Seller Panel</title>
</head>
<body>
<section id="header">
    <a href="#" class="logo" alt="">Seller Panel</a>
    <div>
        <ul id="navbar">
            <li><a href="index.php">ThriftNest</a></li>

        </ul>
    </div>
</section>
<section id="admin1">

<section id="menu">
    <ul class="admin-items">
<li class="active"><i class="fa-solid fa-chart-pie"></i><a class="active" href="#">Dashboard</a></li>
<li><i class="fa-solid fa-list"></i><a href="#">Your Products</a></li>
<li><i class="fa-solid fa-bag-shopping"></i><a href="#">Sales Report</a></li>
<li><i class="fa-solid fa-user"></i><a href="#">Delivery Information</a></li>
<li><i class="fa-solid fa-right-from-bracket"></i><a href="logout.php">Log Out</a></li>
<!-- <li><i class="fa-solid fa-chart-pie"></i><a href="#">Dashboard</a></li> -->
    </ul>
</section>
    <div class="container">
    <div class="content">
        <h3>hi <span>Seller</span></h3>
            <h1>Welcome <span><?php echo $_SESSION['user_name']?></span></h1>
            <!-- <p>This is a Seller's page.</p> -->
            <!-- <a href="login_form.php" class="btn">Login</a>
            <a href="signin.php" class="btn">Register</a> -->
            <a href="logout.php" class="btn">Logout</a>
</div>
</div>
</section>

</body>
</html>