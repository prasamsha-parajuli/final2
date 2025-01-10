    <?php 
     session_start();
    include 'config.php';
    if(!isset($_SESSION['admin_name'])){
        header('location:adminlogin.php');
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
        <title>Admin Panel</title>
    </head>
       <body>
 <section id="header">
    <a href="#" class="logo" alt="">Admin Panel</a>
    <div>
        <ul id="navbar">
            <li><a href="index.php">ThriftNest</a></li>

        </ul>
    </div>
</section>
<section id="admin1">

<section id="menu">
    <ul class="admin-items">
<li class="active"><i class="fa-solid fa-chart-pie"></i><a href="#">Dashboard</a></li>
<li><i class="fa-solid fa-list"></i><a href="product_list.php">Products</a></li>
<li><i class="fa-solid fa-bag-shopping"></i><a href="order_list.php">Ordered Lists</a></li>
<li><i class="fa-solid fa-user"></i><a href="user_list.php">Users List</a></li>
<li><i class="fa-solid fa-users"></i><a href="request_seller.php">Seller's Request</a></li>

<li><i class="fa-solid fa-right-from-bracket"></i><a href="adminlogin.php">Log Out</a></li>
<!-- <li><i class="fa-solid fa-chart-pie"></i><a href="#">Dashboard</a></li> -->
    </ul>
</section>
      
        <section class="working-panel">
                <h2>Welcome <span style="color:red;"><?php echo $_SESSION['admin_name'];?></span></h2>
               
</section>

</section>

    </body>
    </html>