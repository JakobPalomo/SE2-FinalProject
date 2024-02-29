<?php
require_once('dbcon.php'); // Include the database connection file

// Get the ID parameter from the URL
$id = $_GET['id'];

// Update the status of the order to "accepted"
$stmt_update = $con->prepare("UPDATE `pending` SET `status` = 'Accepted' WHERE `id` = ?");
$stmt_update->bind_param("i", $id);
$stmt_update->execute();

// Redirect to user-account.php
header("Location: user-account.php");
exit(); // Ensure script execution stops here
?>