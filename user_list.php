<?php
include 'auth.php';
include 'config.php'; 

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
    <div class="product-table">
        <h3>User-List<h3>
            <table>
                <thead>
                    <tr>
                        <th>User Id</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Phone</th>
                        <th>Action</th>
                    
</tr>
<?php
$sql= "SELECT id, name, email, user_type, phone FROM user_form";
$query=mysqli_query($conn,$sql);
$i=1;
if(mysqli_num_rows($query)<=0){
    echo "No data found in the table";

}
else{
    while ($row = mysqli_fetch_assoc($query)){


 ?>
</thead>
<tbody>
    <tr>
        <td><?php echo $i++.".";?></td>
        <td><?php echo $row['name'];?></td>
        <td><?php echo $row['email'];?></td>
        <td><?php echo $row['user_type'];?></td>
        <td><?php echo $row['phone'];?></td>
        <td class="action-buttons">
            <a href="edit_user.php?id=<?php echo $row['id'];?>" class="edit">Edit</a>
            <a href="delete_user.php?id=<?php echo $row['id'];?>" class="delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
</td>
      
</tr>
<?php
}
}
?>
</tbody>
</table>

</body>
</html>