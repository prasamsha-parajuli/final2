<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $shipping_address = mysqli_real_escape_string($conn, $_POST['address']);

    if (empty($shipping_address)) {
        die("Error: Shipping address is required.");
    }

    // Get total amount
    $total_query = "SELECT SUM(p.product_price) AS total_amount 
                    FROM shopping_cart sc
                    JOIN products p ON sc.product_id = p.product_id
                    WHERE sc.user_id = '$user_id'";
    $total_result = mysqli_query($conn, $total_query);

    if (!$total_result) {
        die("Error fetching total amount: " . mysqli_error($conn));
    }

    $total_data = mysqli_fetch_assoc($total_result);
    $total_amount = $total_data['total_amount'] ?? '0.00';

    // Insert order 
    $query = "INSERT INTO `orders` (user_id, order_date, status, total_amount, shipping_address, payment_status, payment_method, created_at) 
              VALUES ('$user_id', NOW(), 'pending', '$total_amount', '$shipping_address', 'unpaid', 'COD', NOW())";

    if (mysqli_query($conn, $query)) {
        $order_id = mysqli_insert_id($conn);
        $_SESSION['order_id'] = $order_id;

        // Fetch cart items to insert into order_items table
        $cart_query = "SELECT sc.product_id, p.product_price 
                       FROM shopping_cart sc 
                       JOIN products p ON sc.product_id = p.product_id
                       WHERE sc.user_id = '$user_id'";
        $cart_result = mysqli_query($conn, $cart_query);

        while ($cart_item = mysqli_fetch_assoc($cart_result)) {
            // Insert each cart item into order_items table
            $insert_order_item_query = "INSERT INTO order_items (order_id, product_id, product_price)
                                        VALUES ('$order_id', '{$cart_item['product_id']}', '{$cart_item['product_price']}')";
            mysqli_query($conn, $insert_order_item_query);
        }

        // Clear shopping cart after order is placed
        $delete_query = "DELETE FROM shopping_cart WHERE user_id = '$user_id'";
        if (!mysqli_query($conn, $delete_query)) {
            die("Error clearing cart: " . mysqli_error($conn));
        }

        // Redirect to confirmation page
        header("Location: order_confirmation.php");
        exit();
    } else {
        die("Database Error: " . mysqli_error($conn));
    }
}
?>
