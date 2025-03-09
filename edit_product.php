<?php
session_start();
include 'auth.php';
include 'config.php'; 
if (isset($_GET['id'])&& !empty($_GET['id'])){
    $id=(int)$_GET['id'];
    if($id<=0){
        header('location:product_list.php');
        exit();
    }
    $sql_1="SELECT * FROM products WHERE product_id=$id";
$query_1=mysqli_query($conn,$sql_1);
if(mysqli_num_rows($query_1)<=0){
    header('location:product_list.php');
    exit();
}
$old_data=mysqli_fetch_assoc($query_1);
}
else{
    header('location:product_list.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
<?php include 'adminnav.php'?>
<section id="interface">
        <div class="form-container">
            <h3>Edit Product</h3>
<form action="update_product.php?id=<?php echo $old_data['product_id'];?>" method="POST" enctype="multipart/form-data">
    <label for="product_name">Product Name:</label>
    <input type="text" id="product_name" name="product_name" value="<?php echo $old_data['product_name'];?>"required>

    <label for="product_price">Product Price:</label>
    <input type="number" id="product_price" name="product_price" value="<?php echo $old_data['product_price'];?>" required>

    <label for="product_image">Product Image:</label>
    <input type="file" id="product_image" name="product_image" accept="image/*" >
    <img src="<?php echo $old_data['product_image']; ?>" width="50" height="50" alt="Old Image">

    <label for="category">Category:</label>
    <input type="text" id="category" name="category" value="<?php echo $old_data['category'];?>" required>

    <button type="submit" name="update_product">Save Changes</button>
</form>
        </div>
</section>
</body>
</html>