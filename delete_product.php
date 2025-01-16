<?php
include 'auth.php';
include 'config.php';

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = (int)$_GET['id'];
    if($id <= 0){
        header('location:product_list.php');
        exit();
    }
    //old record of  databse retrived from database to display in the form
    $sql_1="SELECT * FROM products where product_id= ".$id;
    $query_1=mysqli_query($conn,$sql_1);

    //validates if there is data in the table or not
    if(!$query_1 || mysqli_num_rows($query_1)<=0){
        header('location:product_list.php');
        exit();

    }

    $sql = "DELETE FROM products WHERE product_id = $id";
    if(mysqli_query($conn, $sql)){
        header('location:product_list.php');
        exit();
    } else {
        echo mysqli_error($conn);
    }
} else {
    header('location:product_list.php');
    exit();
}
