<?php
session_start();
include 'config.php'; 
if (!isset($_SESSION['admin_name'])) {
    header('location:adminlogin.php');
    exit(); 
}
?>
