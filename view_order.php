<?php
include 'auth.php';
include 'config.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Get the order ID from GET
$order_id = isset($_GET['id']) ? $_GET['id'] : null;

// Check if the order ID is valid
if (!$order_id) {
    die('Error: No order ID provided.');
}

// Query to get order details
$query_order = "SELECT * FROM orders WHERE order_id = $order_id";
$result_order = mysqli_query($conn, $query_order);

if (!$result_order) {
    die('Error executing query for order details: ' . mysqli_error($conn));
}

$order_details = mysqli_fetch_assoc($result_order);

// Check if order exists
if (!$order_details) {
    die('Error: Order not found.');
}

// Query to get ordered items with image
$query_items = "SELECT oi.product_id, p.product_name, p.product_price, p.product_image
                FROM order_items oi
                JOIN products p ON oi.product_id = p.product_id
                WHERE oi.order_id = $order_id";
$result_items = mysqli_query($conn, $query_items);

if (!$result_items) {
    die('Error executing query for order items: ' . mysqli_error($conn));
}

$order_items = mysqli_fetch_all($result_items, MYSQLI_ASSOC);

// Check if items exist for the order
if (empty($order_items)) {
    die('Error: No items found for this order.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="admin2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'adminnav.php'?>

<section id="interface">
    <h2>Order Details for Order ID: <?php echo $order_id; ?></h2>

    <!-- Order Details -->
    <div class="admin-profile-container">
        <h3>Order Information</h3>
        <p><strong>Order ID:</strong> <?php echo $order_details['order_id']; ?></p>
        <p><strong>User ID:</strong> <?php echo $order_details['user_id']; ?></p>
        <p><strong>Order Date:</strong> <?php echo $order_details['order_date']; ?></p>
        <p><strong>Order Status:</strong> <?php echo $order_details['status']; ?></p>
        <p><strong>Payment Status:</strong> <?php echo $order_details['payment_status']; ?></p>
    </div>

    <!-- Order Items Table -->
    <h3>Ordered Items</h3>
    <div class="product-table">
    <table>
        <thead>
            <tr>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Price</th>
               
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order_items as $item): ?>
                <tr>
                    <td><img src="<?php echo $item['product_image']; ?>" alt="Product Image" width="50" height="50"></td>
                    <td><?php echo $item['product_name']; ?></td>
                  
                    <td>Rs.<?php echo number_format($item['product_price'], 2); ?></td>
                 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</section>

</body>
</html>
