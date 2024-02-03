<?php
session_start();

unset($_SESSION['authenticated']);
unset($_SESSION['auth_user']);

// Destroy the session
session_destroy();

$_SESSION['status'] = "Logged Out Successfully";
header("Location: login.php");
?>
