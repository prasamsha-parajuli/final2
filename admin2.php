<?php
include 'auth.php';
include 'config.php'; 

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel </title>
    <link rel="stylesheet" href="admin2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <?php include 'adminnav.php'?>
    <section id="interface">
        <h2>Welcome <span style="color:red;"><?php echo $_SESSION['admin_name'];?></span></h2>

    </section>
</body>
</html>