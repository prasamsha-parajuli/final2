
<?php
$conn=mysqli_connect('localhost','root','','ecommerce',3308);
//checking for connection error
if($conn->connect_error){
    die("Connection Failed:".$conn->connection_error);
}
?>

