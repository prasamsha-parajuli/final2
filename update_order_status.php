<?php
session_start(); // Start the session
include 'config.php';

// Get the order ID and status from the POST request
$order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
$status = isset($_POST['status']) ? mysqli_real_escape_string($conn, $_POST['status']) : '';

if ($order_id > 0 && !empty($status)) {
    // Update order status
    $query_update_order = "UPDATE orders SET status = '$status' WHERE order_id = $order_id";
    $result = mysqli_query($conn, $query_update_order);

    if (!$result) {
        die("Error updating order status: " . mysqli_error($conn));
    }

    header("Location: order_list.php");
    exit();
} else {
    die("Invalid order ID or status.");
}
?>
