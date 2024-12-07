<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="style.css">
    <!--font awesome cdn link for icons-->
    <script src="https://kit.fontawesome.com/5fce70dfef.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body id="container1" class="last-try">
    <section id="header">
        <a href="index.html" src="Image/logo.png" class="logo" alt="">ThriftNest</a>
        <div>
            <ul id="navbar">
    <li><a  href="index.html">Home</a></li>
    <li><a  href="shop.html">Shop</a></li>
    <li><a href="blog.html">Blog</a></li>
    <li><a href="about.html">About</a></li>
    <li><a class="active" href="signin.php">Sign in</a></li>
    <li><a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a></li>
            </ul>
        </div>
    </section>



<div id="signUp" class="container" >
   
    <h1 class="form-title">Register</h1>
    <form method="post" action="register.php">
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="fName" placeholder="First Name" id="fName" required>
            <label for="fName">First Name</label>
        </div>
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="lName" placeholder="Last Name" id="lName" required>
            <label for="lName">Last Name</label>
        </div>
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="Email Address" id="email" required>
            <label for="email">Email Address</label>
        </div>
        <!-- <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="Email Address" id="email" required>
            <label for="email">Email Address</label>
        </div> -->
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <label for="password">Password</label>
        </div>
        <input class="btn" type="submit" value="Sign Up" name="signUp">
    </form>
      <div class="links">
        <p>Already have an account?</p>
        <button id="signInButton" class="login">Sign In</button>
    </div>
</div>

<div id="signIn" class="container" style="display:none;">
  
    <h1 class="form-title">Sign In</h1>
    <form method="post" action="register.php">
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="Email Address" id="email" required>
            <label for="email">Email Address</label>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <label for="password">Password</label>
        </div>
        <!-- <p class="recover">
            <a href="#">Recover Password</a>
        </p> -->
        <input class="btn" type="submit" value="Sign In" name="signIn">
    </form>
      <div class="links">
        <p>Don't have an account yet?</p>
        <button id="signUpButton" class="login">Sign Up</button>
    </div>
</div>

    <script src="script.js"></script>
</body>
</html>