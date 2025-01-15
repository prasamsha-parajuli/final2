
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
    <title>Admin panel </title>
    <link rel="stylesheet" href="admin2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <section id="navbar">
        <div class="navigation">
            <div class="logo">
                <h2>ThriftNest</h2>
            </div>
            <div class="logout-btn">
                <a href="logout.html">Log Out</a>
            </div>
        </div>
    </section>

    <section id="menu">
     
        <div class="items">
          
                <li class="active"><i class="fa-solid fa-chart-pie"></i><a href="seller_page.php">Dashboard</a></li>
                <li><i class="fa-solid fa-list"></i><a href="#">Products</a></li>
                <li><i class="fa-solid fa-bag-shopping"></i><a href="#">Ordered Lists</a></li>
                <li><i class="fa-solid fa-user"></i><a href="#">Users List</a></li>
                <li><i class="fa-solid fa-users"></i><a  href="#">Seller's Request</a></li>
                <li><i class="fa-solid fa-right-from-bracket"></i><a href="logout.php">Log Out</a></li>
          
        </div>
    </section>
    <section id="interface">
        <h2>Welcome <span style="color:red;"><?php echo $_SESSION['user_name'];?></span></h2>
    </section>
</body>
</html>