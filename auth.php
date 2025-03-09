<?php
session_start();
include 'config.php'; 
if (!isset($_SESSION['admin_name']) || !isset($_SESSION['admin_id'])) {
    header('location:adminlogin.php');
    exit(); 
}
?>
