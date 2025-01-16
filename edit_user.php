<?php 
include 'auth.php';
include 'config.php'; 


if(isset($_GET['id']) && !empty($_GET['id'])){
    //access granted
    $id=(int)$_GET['id']; //data type casting
    if($id<=0){
        header('location:user_list.php');
        exit();
    }
    //old record of  databse retrived from database to display in the form
    $sql_1="SELECT id, name, email, user_type, phone FROM user_form where id= ".$id;
    $query_1=mysqli_query($conn,$sql_1);

    //validates if there is data in the table or not
    if(mysqli_num_rows($query_1)<=0){
        header('location:user_list.php');
        exit();

    }
    //retriving a single row of existing data from a database table
    $old_data=mysqli_fetch_assoc($query_1);
}
else{
    header('location:user_list.php');
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
            <h3>Edit User</h3>
<form action="update_user.php?id=<?php echo $old_data['id'];?>" method="POST" >
    <label for="user_name">User Name:</label>
    <input type="text" id="user_name" name="user_name" value="<?php echo $old_data['name'];?>">

    <label for="user_email">Email:</label>
    <input type="email" id="user_email" name="user_email" value="<?php echo $old_data['email'];?>" >

    <label for="phone">Phone Number:</label>
    <input type="text" id="phone" name="phone" value="<?php echo $old_data['phone'];?>">

    <button type="submit" name="save_changes">Save Changes</button>
</form>
        </div>
</section>

</body>
</html>