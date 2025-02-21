<?php 
session_start();
include 'config.php';

// Redirect if not logged in
if(!isset($_SESSION['user_name']) || $_SESSION['user_type'] !== 'seller'){
    header('location:login_form.php');
    exit();
}

$seller_id = $_SESSION['seller_id']; // Assuming seller_id is stored in session

// Fetch sold items and earnings
$sold_products_query = "SELECT o.order_id, p.product_name, o.price, o.status 
                        FROM orders o
                        JOIN products p ON o.product_id = p.product_id
                        WHERE o.seller_id = '$seller_id' AND o.status='Delivered'";
$sold_products_result = $conn->query($sold_products_query);

$earning_query = "SELECT SUM(o.price) as total_earnings 
                  FROM orders o
                  WHERE o.seller_id = '$seller_id' AND o.status='Delivered'";
$earning_result = $conn->query($earning_query);
$earnings = $earning_result->fetch_assoc();

// Handle delivery form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $quantity = $_POST['quantity'];
    $pickup_time = $_POST['pickup_time'];

    $delivery_sql = "INSERT INTO deliveries (seller_id, name, address, phone, quantity_kg, pickup_time, status)
                     VALUES ('$seller_id', '$name', '$address', '$phone', '$quantity', '$pickup_time', 'Pending')";
    $conn->query($delivery_sql);
    echo "<script>alert('Delivery request submitted!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="admin2.css">
</head>
<body>
    <section id="navbar">
        <div class="navigation">
            <div class="logo">
                <h2>ThriftNest</h2>
            </div>
            <div class="logout-btn">
                <a href="logout.php">Log Out</a>
            </div>
        </div>
    </section>

    <section id="menu">
        <div class="items">
            <li class="active"><i class="fa-solid fa-chart-pie"></i><a href="seller_dashboard.php">Dashboard</a></li>
            <li><i class="fa-solid fa-list"></i><a href="#">Products List</a></li>
            <li><i class="fa-solid fa-bag-shopping"></i><a href="#">Total Profit</a></li>
            <li><i class="fa-solid fa-user"></i><a href="#">Delivery Information</a></li>
            <li><i class="fa-solid fa-right-from-bracket"></i><a href="logout.php">Log Out</a></li>
        </div>
    </section>

    <section id="interface">
        <h2>Welcome, <span style="color:red;"><?php echo $_SESSION['user_name'];?></span></h2>

        <!-- Sold Items -->
        <div class="product-table">
            <h3>Sold Items</h3>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
                <?php while ($row = $sold_products_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td>$<?php echo $row['price']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
            <h3>Total Earnings: $<?php echo $earnings['total_earnings'] ?: '0'; ?></h3>
        </div>

        <!-- Delivery Form -->
        <div class="form-container">
            <h3>Submit Delivery Request</h3>
            <form method="post">
                <label>Name:</label>
                <input type="text" name="name" required>

                <label>Pickup Address:</label>
                <input type="text" name="address" required>

                <label>Phone:</label>
                <input type="text" name="phone" required>

                <label>Quantity (kg):</label>
                <input type="number" name="quantity" step="0.1" required>

                <label>Preferred Pickup Time:</label>
                <input type="datetime-local" name="pickup_time" required>

                <button type="submit">Submit</button>
            </form>
        </div>
    </section>
</body>
</html>
