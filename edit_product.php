

<?php
include 'auth.php';
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
<form action="product_list.php" method="POST" enctype="multipart/form-data">
    <label for="product_name">Product Name:</label>
    <input type="text" id="product_name" name="product_name">

    <label for="product_price">Product Price:</label>
    <input type="number" id="product_price" name="product_price" >

    <label for="product_image">Product Image:</label>
    <input type="file" id="product_image" name="product_image" accept="image/*" >

    <label for="category">Category:</label>
    <input type="text" id="category" name="category" >

    <button type="submit" name="save_changes">Save Changes</button>
</form>
        </div>
</section>
</body>
</html>