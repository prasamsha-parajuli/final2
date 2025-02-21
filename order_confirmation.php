<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch all transaction details with grouped products
$transaction_query = "
    SELECT t.*, o.order_id, 
           GROUP_CONCAT(p.product_name SEPARATOR ', ') AS products,
           GROUP_CONCAT(p.product_image SEPARATOR ', ') AS product_images
    FROM transactions t
    JOIN orders o ON t.order_id = o.order_id
    JOIN order_items oi ON o.order_id = oi.order_id
    JOIN products p ON oi.product_id = p.product_id
    WHERE t.buyer_id = '$user_id'
    GROUP BY t.transaction_id
    ORDER BY t.transaction_date DESC";

$transaction_result = mysqli_query($conn, $transaction_query);

if (!$transaction_result) {
    die("Error fetching transaction details: " . mysqli_error($conn));
}

$transactions = (mysqli_num_rows($transaction_result) > 0) ? mysqli_fetch_all($transaction_result, MYSQLI_ASSOC) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Details</title>
    <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<section class="cart-container">
    <h1>Transaction Details</h1>
    
    <?php if (!empty($transactions)): ?>
        <div class="cart-table">
            <table>
                <tr>
                    <th>Transaction ID</th>
                    <th>Order ID</th>
                    <th>Products</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th>Payment Method</th>
                    <th>Transaction Date</th>
                </tr>
                <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><?php echo $transaction['transaction_id']; ?></td>
                        <td><?php echo $transaction['order_id']; ?></td>
                        <td>
                            <?php 
                            $product_names = explode(",", $transaction['products']);
                            $product_images = explode(",", $transaction['product_images']);
                            
                            foreach ($product_names as $index => $name): ?>
                                <div class="product-item">
                                <img src="<?php echo trim($product_images[$index]); ?>" alt="" width="50">

                                    <?php echo htmlspecialchars(trim($name)); ?>
                                </div>
                            <?php endforeach; ?>
                        </td>
                        <td>Rs. <?php echo number_format($transaction['amount'], 2); ?></td>
                        <td><?php echo htmlspecialchars($transaction['payment_status']); ?></td>
                        <td><?php echo htmlspecialchars($transaction['payment_method']); ?></td>
                        <td><?php echo date("d M Y, H:i:s", strtotime($transaction['transaction_date'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php else: ?>
        <p>No transaction details found.</p>
    <?php endif; ?>

    <a href="index.php" class="continue-shopping-btn">Back to Home</a>
</section>

<hr>
<?php include 'footer.php'; ?>

</body>
</html>
