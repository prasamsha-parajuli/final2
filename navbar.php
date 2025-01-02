<section id="header">
    <a href="index.php" class="logo">ThriftNest</a>

    <div>
        <ul id="navbar">
            <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a></li>
            <li><a href="shop.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'shop.php' ? 'active' : ''; ?>">Shop</a></li>
            <li><a href="blog.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'active' : ''; ?>">Blog</a></li>
            <li><a href="about.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">About</a></li>
            <li><a href="signin.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'signin.php' ? 'active' : ''; ?>">Sign in</a></li>
            <li><a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a></li>
        </ul>
    </div>
</section>
