<?php 

include 'auth.php';

$sql="UPDATE user_form
SET 
name='".$_POST['user_name']."',
email='".$_POST['user_email']."',
phone='".$_POST['phone']."'
WHERE id=".$_GET['id'];
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