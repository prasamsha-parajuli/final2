<?php
// admin_logout.php
session_start();
session_unset();
session_destroy();
header('Location: adminlogin.php');
exit();
?>