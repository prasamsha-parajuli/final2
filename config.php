
<?php
$conn=mysqli_connect('localhost','root','','ecommerce',3308);
//checking for connection error
if($conn->connect_error){
    die("Connection Failed:".$conn->connection_error);
}
// Khalti API Credentials (*** REPLACE THESE WITH YOUR ACTUAL TEST KEYS ***)
define('KHALTI_PUBLIC_KEY', '96bc05b7c2c3417db62f800912bc5af0'); 
define('KHALTI_SECRET_KEY', '7a17e2366acd475ca1a5f8fb6a96775d'); 
define('KHALTI_VERIFY_URL', 'https://khalti.com/api/v2/payment/verify/'); 
define('BASE_URL', 'http://localhost/final2/');
?>

