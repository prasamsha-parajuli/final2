<?php
session_start();
include 'auth.php';
include 'config.php';

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = (int)$_GET['id'];

    // Retrieve existing product data
    $sql_1 = "SELECT * FROM products WHERE product_id=$id";
    $query_1 = mysqli_query($conn, $sql_1);
    if(mysqli_num_rows($query_1) <= 0){
        header('location:product_list.php');
        exit();
    }
    $old_data = mysqli_fetch_assoc($query_1);

    if(isset($_POST['update_product'])){
        $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
        $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);

     
        $errors = [];
        if(empty($product_name)){
            $errors[] = "Product Name is required.";
        }
        if(empty($product_price) || $product_price <= 0){
            $errors[] = "Product Price is required and must be greater than 0.";
        }
        if(empty($category)){
            $errors[] = "Category is required.";
        }

        // Handle the image
        $product_image = $old_data['product_image'];  // Keep the old image by default
        if(!empty($_FILES['product_image']['name'])){
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if(in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])){
                if(move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)){
                    $product_image = $target_file; // Update with new image
                } else {
                    $errors[] = "Error uploading image.";
                }
            } else {
                $errors[] = "Invalid image format. Only JPG, PNG, JPEG, GIF are allowed.";
            }
        }

        // If no errors, proceed with updating
        if(empty($errors)){
            $sql = "UPDATE products
                    SET 
                    product_name='$product_name',
                    product_price='$product_price',
                    product_image='$product_image',
                    category='$category'
                    WHERE product_id=$id";

            if(mysqli_query($conn, $sql)){
                header('location:product_list.php');
                exit();
            } else {
                echo mysqli_error($conn);
            }
        } else {
            // Display errors
            foreach($errors as $error){
                echo "<p style='color:red;'>$error</p>";
            }
        }
    }
} else {
    header('location:product_list.php');
    exit();
}
?>
