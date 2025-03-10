<?php
session_start();
include_once 'config.php';
?>
<section id="header">
    <a href="index.php" class="logo">ThriftNest</a>

    <div>
        <ul id="navbar">
            <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a></li>
            <li><a href="blog.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'active' : ''; ?>">Blog</a></li>
            <li><a href="about.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">About</a></li>
            
            <!-- Check if user is logged in -->
            <?php if (isset($_SESSION['user_name'])): ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="signin.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'signin.php' ? 'active' : ''; ?>">Sign in</a></li>
            <?php endif; ?>
            
            <li><a href="cart.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'cart.php' ? 'active' : ''; ?>"><i class="fa-solid fa-bag-shopping"></i></a></li>
            <li><a href="order_confirmation.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'order_confirmation.php' ? 'active' : ''; ?>">Orders</a></li>
        </ul>
    </div>
</section>
