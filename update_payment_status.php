<?php
session_start();
include 'config.php';

// Get the order ID and payment status from the POST request
$order_id = $_POST['order_id'];
$payment_status = $_POST['payment_status'];

// Update the payment status in the orders table
$query = "UPDATE orders SET payment_status = '$payment_status' WHERE order_id = '$order_id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Error updating payment status: ' . mysqli_error($conn));
}

header('Location: order_list.php');
exit();
?>
