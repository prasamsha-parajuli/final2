
<?php
$conn=mysqli_connect('localhost','root','','user_db',3308);
//checking for connection error
if($conn->connect_error){
    die("Connection Failed:".$conn->connection_error);
}
?>

