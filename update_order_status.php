<?php
include 'config.php';

// Get the order ID and the new status
$order_id = $_POST['order_id'];
$status = $_POST['status'];

// Update the order status
$query_update_order = "UPDATE orders SET status = '$status' WHERE order_id = $order_id";
mysqli_query($conn, $query_update_order);

// Update the transaction status for the respective order
$query_update_transaction = "UPDATE transactions SET payment_status = '$status' WHERE order_id = $order_id";
mysqli_query($conn, $query_update_transaction);

// Redirect to the admin orders page
header("Location: order_list.php");
exit();
?>
