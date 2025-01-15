<?php
include 'auth.php';

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
    <input type="text" id="product_name" name="product_name" required>

    <label for="product_price">Product Price:</label>
    <input type="number" id="product_price" name="product_price" required>

    <label for="product_image">Product Image:</label>
    <input type="file" id="product_image" name="product_image" accept="image/*" required>


    <label for="category">Category:</label>
    <input type="text" id="category" name="category" required>

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
    <tr>
        <td>101</td>
        <td>Olive Green Cotton Fannel</td>
        <td>Rs. 200</td>
        <td><img src='placeholder-a.jpg' alt='Product A'></td>
        <td>Shirt</td>
        <td class="action-buttons">
            <a href="edit_product.php" class="edit">Edit</a>
            <a href="delete_product.php" class="delete">Delete</a>
</td>
      
</tr>
</tbody>
</table>
       </div>
    </section>
</body>
</html>