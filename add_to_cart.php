<?php
session_start();
include 'config.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Get the product ID and quantity from the POST request
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$quantity = 1; // Default quantity is 1

$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
echo "Received Product ID: " . $product_id;

// Debugging: Check the value of $product_id
echo "Product ID: " . $product_id . "<br>";

// Stop execution temporarily to check the value
if ($product_id === 0) {
    die("Invalid product ID received from the form.");
}

// Check if the product ID is valid
$product_check_query = "SELECT * FROM products WHERE product_id = $product_id";
$result = mysqli_query($conn, $product_check_query);

if (mysqli_num_rows($result) === 0) {
    die("Invalid product ID: $product_id");
}

// Check if the product is already in the cart
$cart_check_query = "SELECT * FROM shopping_cart WHERE user_id = $user_id AND product_id = $product_id";
$result = mysqli_query($conn, $cart_check_query);

if (mysqli_num_rows($result) > 0) {
    // Update the quantity if the product already exists in the cart
    $update_query = "UPDATE shopping_cart SET quantity = quantity + $quantity WHERE user_id = $user_id AND product_id = $product_id";
    mysqli_query($conn, $update_query);
} else {
    // Insert a new row if the product is not in the cart
    $insert_query = "INSERT INTO shopping_cart (user_id, product_id, quantity, created_at) VALUES ($user_id, $product_id, $quantity, NOW())";
    mysqli_query($conn, $insert_query);
}

// Redirect to the cart page after adding the product
header("Location: cart.php");
exit();
?>
