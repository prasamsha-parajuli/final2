<?php
include 'config.php';
session_start();
session_unset();
session_destroy();

// Redirect to the homepage after logout
header('location:index.php');
exit();
?>
