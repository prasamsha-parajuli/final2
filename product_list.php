<?php
include 'auth.php';
include 'config.php'; 
$product_name=$product_price=$category="";
$product_name_err=$product_price_err= $category_err=$image_err="";


if(isset($_POST['add_product'])){
    if(empty($_POST['product_name'])){
        $product_name_err="Product name is required.";
    }
    else{
        $product_name=mysqli_real_escape_string($conn, $_POST['product_name']);
    }
    if(empty($_POST['product_price']) || $_POST['product_price']<=0){
        $product_price_err="Please enter a valid product price.";
    }
    else{
        $product_price=mysqli_real_escape_string($conn, $_POST['product_price']);
    }
    if(empty($_POST['category'])){
        $category_err="Category is required.";
    }
    else{
        $category=mysqli_real_escape_string($conn, $_POST['category']);
    }
   
    
    //holds path of directory where image will be stored
    $target_dir="uploads/";
    $target_file=$target_dir.basename($_FILES["product_image"]["name"]);
    $target_file = mysqli_real_escape_string($conn, $target_file);
    $imageFileType=strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if(empty($_FILES["product_image"]["name"])){
        $image_err="Image is required.";
    }
    else{
        $check=getimagesize($_FILES["product_image"]["tmp_name"]);
        if($check===false){
            $image_err="File is not an image.";

        }
        elseif(!in_array($imageFileType,['jpg','jpeg','png','gif'])){
            $image_err="Only JPG, PNG, JPEG, GIF files are allowed.";
        }
        else
        {
            if(!move_uploaded_file($_FILES["product_image"]["tmp_name"],$target_file)){
            $image_err="There was an error uploading this image.";
        }
    }
}
    if(empty($product_name_err)&& empty($product_price_err)&& empty($category_err)&& empty($image_err)){
       
        $query="INSERT INTO products(product_name,product_price,product_image,category)
        VALUES('$product_name','$product_price','$target_file','$category')";
        if(mysqli_query($conn,$query)){
            echo "<p style='color:green;'>Product Added Successfully!</p>";
        }
        else{
            echo "<p style='color:red;'>Error:".$query."<br>".mysqli_error($conn)."</p>";
        }
    }


}


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
        <div class="form-container">
            <h3>Add Product</h3>
<form action="product_list.php" method="POST" enctype="multipart/form-data">
    <label for="product_name">Product Name:</label>
    <input type="text" id="product_name" name="product_name" >
    <span style="color:red;"><?php echo $product_name_err;?></span>

    <label for="product_price">Product Price:</label>
    <input type="number" id="product_price" name="product_price" >
    <span style="color:red;"><?php echo $product_price_err;?></span>

    <label for="product_image">Product Image:</label>
    <input type="file" id="product_image" name="product_image" accept="image/*" >
    <span style="color:red;"><?php echo $image_err;?></span>


    <label for="category">Category:</label>
    <input type="text" id="category" name="category" >
    <span style="color:red;"><?php echo $category_err;?></span>

    <button type="submit" name="add_product">Add Product</button>
</form>
        </div>
         <!-- Product List Table -->
       <div class="product-table">
        <h3>Product-List<h3>
            <table>
                <thead>
                    <tr>
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Action</th>
                    
</tr>
</thead>
<tbody>
    <?php 
    $query="SELECT * FROM products ";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
?>
       
    
    <tr>
        <td><?php echo $row['product_id'];?></td>
        <td><?php echo $row['product_name'];?></td>
        <td><?php echo $row['product_price'];?></td>
        <td><img src="<?php echo $row['product_image']; ?>" alt='Product Img' width='50' height='50'></td>
        <td><?php echo $row['category'];?></td>
        <td class='action-buttons'>
            <a href="edit_product.php?id=<?php echo $row['product_id']; ?>" class='edit'>Edit</a>
            <a  href="delete_product.php?id=<?php echo $row['product_id']; ?>" class='delete' onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
</td>
      
</tr>
<?php
}
    }
else{
    echo "<tr><td colspan='6'>No products found</td></tr>";
}
?>
</tbody>
</table>
       </div>
    </section>
</body>
</html>