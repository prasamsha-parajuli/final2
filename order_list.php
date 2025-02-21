<?php
include 'auth.php';
include 'config.php';

// Query to fetch all orders along with order items
$query = "SELECT o.order_id, o.user_id, o.order_date, o.status AS status, o.payment_status, 
                 oi.product_id, oi.quantity, p.product_name
          FROM orders o
          JOIN order_items oi ON o.order_id = oi.order_id
          JOIN products p ON oi.product_id = p.product_id";
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
                    <th>Order Date</th>
                    <th>Order Status</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo $order['order_id']; ?></td>
                        <td><?php echo $order['user_id']; ?></td>
                        <td><?php echo $order['order_date']; ?></td>
                        <td>
                            <form method="POST" action="update_order_status.php">
                                <select name="status" onchange="this.form.submit()">
                                    <option value="Pending" <?php echo $order['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Completed" <?php echo $order['status'] == 'Completed' ? 'selected' : ''; ?>>Delivered</option>
                                    <option value="Cancelled" <?php echo $order['status'] == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>

                                </select>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="update_payment_status.php">
                                <select name="payment_status" onchange="this.form.submit()">
                                    <option value="Unpaid" <?php echo $order['payment_status'] == 'Unpaid' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Paid" <?php echo $order['payment_status'] == 'Paid' ? 'selected' : ''; ?>>Paid</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <a href="view_order.php?id=<?php echo $order['order_id']; ?>" class="view">View Details</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

</body>
</html>
