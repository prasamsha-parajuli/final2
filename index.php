<?php
session_start();
include 'config.php';
// Exclude products already in the cart or purchased
$query = "
    SELECT * FROM products p 
    WHERE p.product_id NOT IN (
        SELECT product_id FROM shopping_cart WHERE user_id = '{$_SESSION['user_id']}'
    )
    AND p.product_id NOT IN (
        SELECT product_id FROM order_items
    )
";
$result = mysqli_query($conn, $query);
$products = mysqli_num_rows($result) > 0 ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThriftNest</title>
    <link rel="stylesheet" href="style.css">
    <!--font awesome cdn link for icons-->
    <script src="https://kit.fontawesome.com/5fce70dfef.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
<!-- index.php -->
<?php include 'navbar.php'; ?>

<section id="banner">
    <h4>Get-Started!!!</h4>
    <h2>Thrift Affordable Items </h2>
    <h1>Get Amazing Deals!</h1>
    <p>Choose sustainable products without compromising your style!</p>
    <button> <a href="#" style="text-decoration: none; color:#551A8B;">Happy Thrifting!</a></button>

</section>
<hr>
<!-- </section> -->

<!-- <section id="banner2" class="section-m1">
<h4>Eager to Buy?</h4>
<h2>Signin now to find your <span>Unigue Style.</span></h2>
<button class="normal">Sign In</button>
</section> -->
    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Stock Clearance Thrifts for 2025 </p>
        <div class="pro-container">
            <?php foreach($products as $product):?>
          
  <div class="pro" id="product-<?php echo $product['product_id']; ?>">
    <img src="<?php echo htmlspecialchars($product['product_image']);?>">
    <div class="description">
        <span><?php echo htmlspecialchars($product['category']);?></span>
        <h5><?php echo htmlspecialchars($product['product_name']);?></h5>
        <h4>Rs.<?php echo htmlspecialchars($product['product_price']);?></h4>
    </div>
    <div class="button-container">
        <form action="add_to_cart.php" method="POST" class="button-form" onsubmit="hideProduct(<?php echo $product['product_id']; ?>)">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">
            <button type="submit" class="btn add-to-cart">Add to Cart</button>
        </form>
    </div>
</div>
            <?php endforeach; ?>
            
          
           
   </section>
   <hr>
<!-- </section> -->

<!-- <section id="banner2" class="section-m1">
<h4>Looking for something?</h4>
<h2>Browse different categories to match your <span>Unigue Style.</span></h2>
<button class="normal">Explore More</button>
</section> -->



<!-- <hr> -->
<?php include 'footer.php'; ?>
    <script src="script.js"></script>
</body>
</html>