    <?php
      session_start();
    require 'config.php';
    $error=[];
    if(isset($_POST['submit'])){
        $name=trim($_POST['name']);
        $email=trim($_POST['email']);
        $pass=$_POST['password'];
        $cpass=$_POST['cpassword'];
        $user_type=$_POST['user_type'];
    //server side validation
        if(empty($name)||empty($email)||empty($pass)||empty($cpass)){
            $error[]='All fields are required';
        }
        elseif(!preg_match("/^[a-zA-Z\s]+$/", $name)){
            $error[]='Name should only contain letters';
        }
        elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $error[]='Invalid Email format!';
        }

    elseif($pass!=$cpass){
            $error[]='Password donot match!'; 
        
    }
        else{
            //checks if the email already exists
            $stmt=$conn->prepare("SELECT * FROM user_form WHERE email=? ");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result=$stmt->get_result();

        if($result->num_rows>0){
            $error[]='User already exist!';
        }
        else{
            //checks admin count
            if($user_type==='admin'){
                $stmt=$conn->prepare("SELECT COUNT(*) as count from user_form where user_type='admin'");
                $stmt->execute();
                $adminCount=$stmt->get_result()->fetch_assoc()['count'];
                if($adminCount>=2){
                    $error[]="Admin account limit reached";
                } 
            }
            if(empty($error)){
                //inserts user
                $hashedPass=password_hash($pass,PASSWORD_BCRYPT);
                $stmt=$conn->prepare("INSERT INTO user_form(name,email,password,user_type) VALUES(?,?,?,?)");
                $stmt->bind_param("ssss", $name,$email,$hashedPass,$user_type);
                if($stmt->execute()){
                    header('location:login_form.php');
                    exit();
                }
                else{
               $error[]='Registration Failed, Please try again later.';
                }
            }
    }
        }
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
     <!--font awesome cdn link for icons-->
     <script src="https://kit.fontawesome.com/5fce70dfef.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   
</head>
<body>
<!-- signin.php -->
<?php include 'navbar.php'; ?>

    <div class="form-container">
       
        <form action="" method="POST">
        <h3>Registration Form</h3>

        <?php 
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error_msg">'.$error.'</span>';
            };
        };
        ?>
               <input type="text"  name="name" required placeholder="Full Name">
                <input type="email"  name="email" required placeholder="Email">
                <input type="password"  name="password" required placeholder="Password">
                <input type="password"  name="cpassword" required placeholder="Confirm Password">
                <select name="user_type">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
</select>

                <input type="submit" name="submit" value="Register" class="form-btn">
                <p>Already have an account?<a href="login_form.php">Login</a></p>


</form>
</div>

</body>
</html>