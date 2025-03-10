<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch all order details with grouped products
$order_query = "
    SELECT o.*, 
           GROUP_CONCAT(p.product_name SEPARATOR ', ') AS products,
           GROUP_CONCAT(p.product_image SEPARATOR ', ') AS product_images
    FROM orders o
    JOIN order_items oi ON o.order_id = oi.order_id
    JOIN products p ON oi.product_id = p.product_id
    WHERE o.user_id = '$user_id'
    GROUP BY o.order_id
    ORDER BY o.order_date DESC";

$order_result = mysqli_query($conn, $order_query);

if (!$order_result) {
    die("Error fetching order details: " . mysqli_error($conn));
}

$orders = (mysqli_num_rows($order_result) > 0) ? mysqli_fetch_all($order_result, MYSQLI_ASSOC) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="style.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
<?php include 'navbar.php'; ?>

<section class="cart-container">
    <h1>Order Details</h1>
    
    <?php if (!empty($orders)): ?>
        <div class="cart-table">
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Products</th>
                    <th>Total Amount</th>
                    <th>Order Status</th>
                    <th>Payment Status</th>
                    <th>Payment Method</th>
                    <th>Order Date</th>
                </tr>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo $order['order_id']; ?></td>
                        <td>
                            <?php 
                            $product_names = explode(",", $order['products']);
                            $product_images = explode(",", $order['product_images']);
                            
                            foreach ($product_names as $index => $name): ?>
                                <div class="product-item">
                                    <img src="<?php echo trim($product_images[$index]); ?>" alt="" width="50">
                                    <?php echo htmlspecialchars(trim($name)); ?>
                                </div>
                            <?php endforeach; ?>
                        </td>
                        <td>Rs. <?php echo number_format($order['total_amount'], 2); ?></td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                        <td><?php echo htmlspecialchars($order['payment_status']); ?></td>
                        <td><?php echo htmlspecialchars($order['payment_method']); ?></td>
                        <td><?php echo date("d M Y, H:i:s", strtotime($order['order_date'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php else: ?>
        <p>No order details found.</p>
    <?php endif; ?>

    <a href="index.php" class="continue-shopping-btn">Back to Home</a>
</section>

<hr>
<?php include 'footer.php'; ?>

</body>
</html>
