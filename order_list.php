<?php
include 'auth.php';
include 'config.php';

// Query to fetch all orders along with order items
$query = "SELECT o.order_id, o.user_id, o.order_date, o.status AS status, o.payment_status
          FROM orders o";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Error executing query: ' . mysqli_error($conn));
}

if(mysqli_num_rows($result) > 0) {
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $orders = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Orders</title>
    <link rel="stylesheet" href="admin2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'adminnav.php'?>

<section id="interface">
    <h2>Orders Management</h2>
    
    <!-- Orders Table -->
    <div class="product-table">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Order Status</th>
                    <th>Payment Status</th>
                    <th>Products</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo $order['order_id']; ?></td>
                        <td><?php echo $order['user_id']; ?></td>
                  
                        <td>
                        <form method="POST" action="update_order_status.php">
    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
    <select name="status" onchange="this.form.submit()">
        <option value="pending" <?php echo $order['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
        <option value="completed" <?php echo $order['status'] == 'completed' ? 'selected' : ''; ?>>Delivered</option>
        <option value="cancelled" <?php echo $order['status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
    </select>
</form>

                        </td>
                        <td>
                        <form method="POST" action="update_payment_status.php">
    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
    <select name="payment_status" onchange="this.form.submit()">
        <option value="unpaid" <?php echo $order['payment_status'] == 'unpaid' ? 'selected' : ''; ?>>Pending</option>
        <option value="paid" <?php echo $order['payment_status'] == 'paid' ? 'selected' : ''; ?>>Paid</option>
    </select>
</form>

                        </td>
                        <td>
                            <a href="view_order.php?id=<?php echo $order['order_id']; ?>" class="view">View Product</a>
                        </td>
                        <td><?php echo $order['order_date']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

</body>
</html>
