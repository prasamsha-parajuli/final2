<?php 
include 'auth.php';
if(isset($_GET['id']) && !empty($_GET['id'])){
    //access granted
    $id=(int)$_GET['id']; //data type casting
    if($id<=0){
        header('location:user_list.php');
        exit();
    }
    //old record of  databse retrived from database to display in the form
    $sql_1="SELECT id, name, email, user_type, phone FROM user_form where $id= ".$id;
    $query_1=mysqli_query($conn,$sql_1);

    //validates if there is data in the table or not
    if(mysqli_num_rows($query_1)<=0){
        header('location:user_list.php');
        exit();

    }
    $sql="DELETE FROM user_form WHERE id=".$id;
    $query=mysqli_query($conn,$sql);
     
    if ($query){
        //sucess 
        header('location:user_list.php');
        exit();
    }
    else{
        header('location:user_list.php');
        exit();  
    } 
}
else{
    header('location:user_list.php');
    exit();  
} 

?>