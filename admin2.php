<?php
session_start();
include 'auth.php';
include 'config.php';

// Fetch Admin Data from user_info table
$adminData = null;
$sql = "SELECT * FROM user_form WHERE user_type = 'admin' LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $adminData = mysqli_fetch_assoc($result);
}

// Get Total Users
$sql_users = "SELECT COUNT(*) AS total_users FROM user_form WHERE user_type != 'admin'";
$result_users = mysqli_query($conn, $sql_users);
$total_users = mysqli_fetch_assoc($result_users)['total_users'];

// Get Total Products
$sql_products = "SELECT COUNT(*) AS total_products FROM products";
$result_products = mysqli_query($conn, $sql_products);
$total_products = mysqli_fetch_assoc($result_products)['total_products'];

// Get Total Orders
$sql_orders = "SELECT COUNT(*) AS total_orders FROM orders";
$result_orders = mysqli_query($conn, $sql_orders);
$total_orders = mysqli_fetch_assoc($result_orders)['total_orders'];

// Get Total Sales (using orders table)
$sql_sales = "SELECT SUM(total_amount) AS total_sales FROM orders WHERE status = 'completed'";
$result_sales = mysqli_query($conn, $sql_sales);
$total_sales = mysqli_fetch_assoc($result_sales)['total_sales'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <?php include 'adminnav.php' ?>

    <section id="interface">
        <h2>Welcome <span style="color:purple;"><?php echo $_SESSION['admin_name']; ?></span></h2>

        <div class="dashboard">
            <div class="box"> <h3><?php echo $total_users; ?></h3><p>Total Users</p> </div>
            <div class="box"> <h3><?php echo $total_products; ?></h3><p>Total Products</p> </div>
            <div class="box"> <h3><?php echo $total_orders; ?></h3><p>Total Orders</p> </div>
            <div class="box"> <h3>Rs.<?php echo number_format($total_sales, 2); ?></h3><p>Total Sales</p> </div>
        </div>

        <section class="admin-profile-container">
            <div class="profile-image">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="profile-details">
                <h3>Your Profile</h3>
                <?php 
                    $sql = "SELECT user_id, name, email, phone, address FROM user_form WHERE user_type = 'admin' LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    $admin = mysqli_fetch_assoc($result);
                ?>
                <p><strong>Admin Name:</strong> <?php echo $admin['name']; ?></p>
                <p><strong>Email:</strong> <?php echo $admin['email']; ?></p>
                <p><strong>Phone:</strong> <?php echo $admin['phone']; ?></p>
                <p><strong>Address:</strong> <?php echo $admin['address']; ?></p>
            </div>
            <button class="edit-profile" onclick="window.location.href='edit_user.php?id=<?php echo $admin['user_id']; ?>'">Edit Profile</button>
        </section>
    </section>
</body>
</html>
