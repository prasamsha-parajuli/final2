<?php
session_start();
require 'config.php';

$adminError=[];
$email='';//initializing email to use in the form 


if($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['submit'])){
    $email=trim($_POST['email']);
    $pass=$_POST['password'];
    if(empty($email) ||empty($pass)){
      $adminError[]='All fields are required';

    } 
    else{
      $stmt=$conn->prepare("SELECT * FROM user_form WHERE email=?");
      $stmt->bind_param("s", $email);
      $stmt->execute();

      $result=$stmt->get_result();
  
      if($result->num_rows>0){
        $admin=$result->fetch_assoc() ;
  if(password_verify($pass,$admin['password'])){
    $_SESSION['admin_name']=$admin['name'];
    if ($admin['user_type'] === 'admin') {
        header('Location: admin2.php');
        exit();
    }

  }
        else{
          $adminError[]='Invalid admin username or password';
        }
      }
        else{
          $adminError[]='Invalid admin username or password';
        }
    }

};
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="signin.css">
     <!--font awesome cdn link for icons-->
     <script src="https://kit.fontawesome.com/5fce70dfef.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   
</head>
<body>
<!-- login_form.php -->



    <div class="form-container">
       
        <form action="" method="POST">
        <h3>Login Form</h3>
        <?php if (!empty($adminError)) { ?>
            <?php foreach ($adminError as $error) { ?>
                <span class="error_msg"><?php echo $error; ?></span>
            <?php } ?>
        <?php } ?>
                <input type="email"  name="email"  placeholder="Email" value="<?php echo htmlspecialchars($email);?>">
                <input type="password"  name="password"  placeholder="Password">
                <input type="submit" name="submit" value="Login" class="form-btn">
              


</form>
</div>

</body>
</html>