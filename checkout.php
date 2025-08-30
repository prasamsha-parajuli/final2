<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$query = "SELECT name, phone, address FROM user_form WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
$user_data = mysqli_fetch_assoc($result);
$name = $user_data['name'] ?? '';
$phone = $user_data['phone'] ?? '';
$address = $user_data['address'] ?? '';

// Calculate total amount
$total_query = "SELECT SUM(p.product_price) AS total_amount
                FROM shopping_cart sc
                JOIN products p ON sc.product_id = p.product_id
                WHERE sc.user_id = '$user_id'";
$total_result = mysqli_query($conn, $total_query);
$total_data = mysqli_fetch_assoc($total_result);
$total_amount = $total_data['total_amount'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<!-- Checkout Form -->
<section class="checkout-container">
    <h1>Delivery Information </h1>
    <form action="checkout_process.php" method="POST" class="checkout-form">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>

        <label for="address">Shipping Address:</label>
        <textarea name="address" required><?php echo htmlspecialchars($address); ?></textarea>

        <!-- Total Amount (Readonly) -->
        <label for="total_amount">Total Amount:</label>
        <input type="text" name="total_amount" value="Rs. <?php echo number_format($total_amount, 2); ?>" readonly>

        <!-- Payment Method -->
        <label for="payment_method">Payment Method:</label>
        <select name="payment_method" required>
            <option value="COD" <?php echo (isset($_POST['payment_method']) && $_POST['payment_method'] == 'COD') ? 'selected' : ''; ?>>Cash on Delivery (COD)</option>
            <option value="Khalti" <?php echo (isset($_POST['payment_method']) && $_POST['payment_method'] == 'Khalti') ? 'selected' : ''; ?>>Khalti</option>
        </select>

        <button type="submit">Proceed to Payment</button>
    </form>
</section>
<hr>
<?php include 'footer.php'; ?>
</body>
</html>