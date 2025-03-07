<?php
session_start();
include 'config.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Logged-in user's ID

// Remove item from cart
if (isset($_GET['remove_id'])) {
    $remove_id = $_GET['remove_id'];
    $query = "DELETE FROM shopping_cart WHERE cart_id = $remove_id AND user_id = $user_id";
    mysqli_query($conn, $query);
    header("Location: cart.php"); // Redirect back to the cart page after removal
    exit();
}

// Automatically remove items from cart if held for more than 24 hours
$timeout_query = "DELETE FROM shopping_cart WHERE TIMESTAMPDIFF(HOUR, created_at, NOW()) > 24";
mysqli_query($conn, $timeout_query);

// Fetch cart items for the user
$query = "SELECT sc.cart_id, sc.product_id, p.product_name, p.product_price, p.product_image, sc.created_at
          FROM shopping_cart sc
          JOIN products p ON sc.product_id = p.product_id
          WHERE sc.user_id = $user_id";
$result = mysqli_query($conn, $query);

$cart_items = [];
$total_price = 0;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cart_items[] = $row;
        $total_price += $row['product_price'];
    }
} else {
    $cart_empty = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="cart-container">
        <h1>My Cart</h1>
<p style="color:red;">Make sure that you purchase the items within the 24 hours time frame, otherwise it will be released back.</p>
        <?php if (isset($cart_empty)): ?>
            <p class="empty-cart-msg">Your cart is empty!!</p>
            <a href="index.php" class="continue-shopping-btn">Continue Shopping</a>
        <?php else: ?>
            <form action="checkout.php" method="POST">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sn=1;?>
                        <?php foreach ($cart_items as $item): ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td>
                                    <img src="<?php echo htmlspecialchars($item['product_image']); ?>" alt="Product Image" class="product-img">
                                    <?php echo htmlspecialchars($item['product_name']); ?>
                                </td>
                                <td>Rs. <?php echo htmlspecialchars($item['product_price']); ?></td>
                                <td>
                                    <a href="cart.php?remove_id=<?php echo $item['cart_id']; ?>" onclick="return confirm('Are you sure you want to remove this item?')" class="remove-btn">Remove</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="cart-summary">
                    <p style= "font-weight:bold;">Total Price: Rs. <?php echo $total_price; ?></p>
                    <button type="submit" class="checkout-btn">Proceed to Checkout</button>
                    <a href="index.php" class="continue-shopping-btn">Continue Shopping</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
    <hr>
    <?php include 'footer.php'; ?>
</body>
</html>
