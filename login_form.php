<?php
session_start();
require 'config.php';
$generalError=[];
if($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['submit'])){
    $email=trim($_POST['email']);
    $pass=$_POST['password'];
    if(empty($email) ||empty($pass)){
      $generalError[]='All fields are required';

    } 
    else{
      $stmt=$conn->prepare("SELECT * FROM user_form WHERE email=? ");
      $stmt->bind_param("s", $email);
      $stmt->execute();

      $result=$stmt->get_result();
  
      if($result->num_rows>0){
        $user=$result->fetch_assoc() ;
  if(password_verify($pass,$user['password'])){
    $_SESSION['user_name']=$user['name'];
      header('Location:user_page.php');
      exit();
  }
        else{
          $generalError[]='Incorrect password';
        }
      }
        else{
          $generalError[]='No user found with this email';
        }
    }

};
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="signin.css">
     <!--font awesome cdn link for icons-->
     <script src="https://kit.fontawesome.com/5fce70dfef.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   
</head>
<body>
<!-- login_form.php -->
<?php include 'navbar.php'; ?>


    <div class="form-container">
       
        <form action="" method="POST">
        <h3>Login Form</h3>
        <?php if (!empty($generalError)) { ?>
            <?php foreach ($generalError as $error) { ?>
                <span class="error_msg"><?php echo $error; ?></span>
            <?php } ?>
        <?php } ?>
                <input type="email"  name="email"  placeholder="Email" value="<?php echo htmlspecialchars($email);?>">
                <input type="password"  name="password"  placeholder="Password">
                <input type="submit" name="submit" value="Login" class="form-btn">
                <p>Don't have an account?<a href="signin.php">Register</a></p>


</form>
</div>

</body>
</html>