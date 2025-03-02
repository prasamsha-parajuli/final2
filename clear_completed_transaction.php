<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}

$transaction_id = $_GET['transaction_id'];

// Validate the transaction ID
if (!$transaction_id) {
    die('Error: Invalid transaction ID.');
}

// Delete the transaction for the user
$query_clear_transaction = "DELETE FROM transactions WHERE transaction_id = $transaction_id AND buyer_id = $_SESSION[user_id]";
$result = mysqli_query($conn, $query_clear_transaction);

if (!$result) {
    die('Error deleting transaction: ' . mysqli_error($conn));
}

// Redirect back to the user's transaction page
header("Location:order_confirmation.php");
exit();
?>
