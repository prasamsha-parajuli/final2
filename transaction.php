<?php
include 'auth.php';
include 'config.php';

// Query to get all transactions along with the order status
$query_transactions = "SELECT t.transaction_id, t.order_id, t.amount, t.payment_status, t.transaction_date, o.status AS order_status
                       FROM transactions t
                       JOIN orders o ON t.order_id = o.order_id";
$result_transactions = mysqli_query($conn, $query_transactions);

if (!$result_transactions) {
    die('Error executing query: ' . mysqli_error($conn));
}

if (mysqli_num_rows($result_transactions) > 0) {
    $transactions = mysqli_fetch_all($result_transactions, MYSQLI_ASSOC);
} else {
    $transactions = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <link rel="stylesheet" href="admin2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'adminnav.php'?>

<section id="interface">
    <h2>Transaction Details</h2>
    
    <!-- Transaction Table -->
    <div class="product-table">
    <table>
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Order ID</th>
                <th>Amount</th>
                <th>Order Status</th> <!-- Updated column name -->
                <th>Payment Status</th>
                <th>Transaction Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?php echo $transaction['transaction_id']; ?></td>
                    <td><?php echo $transaction['order_id']; ?></td>
                    <td>Rs.<?php echo number_format($transaction['amount'], 2); ?></td>
                    <td><?php echo $transaction['order_status']; ?></td> <!-- Display order status -->
                    <td><?php echo $transaction['payment_status']; ?></td>
                    <td><?php echo $transaction['transaction_date']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</section>

</body>
</html>
