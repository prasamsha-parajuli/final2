<?php 
session_start();
include 'auth.php';
include 'config.php'; 


$sql="UPDATE user_form
SET 
name='".$_POST['user_name']."',
email='".$_POST['user_email']."',
phone='".$_POST['phone']."',
address='".$_POST['address']."'
WHERE user_id=".$_GET['id'];
//executing query in databaase
$query=mysqli_query($conn,$sql);
if($query){
    //sucess
    header('location:user_list.php');
    exit();

}
else{
    echo mysqli_error($conn);
}
?>