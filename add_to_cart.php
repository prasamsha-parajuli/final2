<?php
 session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

if ($product_id === 0) {
    die("Invalid product ID received from the form.");
}

// Check if the product exists
$product_check_query = "SELECT * FROM products WHERE product_id = $product_id";
$result = mysqli_query($conn, $product_check_query);

if (mysqli_num_rows($result) === 0) {
    die("Invalid product ID: $product_id");
}

// Check if the product is already in the cart (shouldn't happen since each product is unique)
$cart_check_query = "SELECT * FROM shopping_cart WHERE user_id = $user_id AND product_id = $product_id";
$result = mysqli_query($conn, $cart_check_query);

if (mysqli_num_rows($result) === 0) {
    // Insert product into cart 
    $insert_query = "INSERT INTO shopping_cart (user_id, product_id, created_at) VALUES ($user_id, $product_id, NOW())";
    mysqli_query($conn, $insert_query);
}

// Redirect to cart page
header("Location: cart.php");
exit();
?>