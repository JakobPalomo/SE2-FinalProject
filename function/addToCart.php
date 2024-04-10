<?php
session_start();

// Retrieve the item JSON string from the AJAX request
$itemJSON = $_POST['item'];
$item = json_decode($itemJSON, true);

// Initialize or retrieve cart from the session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Add the item to the cart array in the session
$_SESSION['cart'][] = $item;

// You can optionally return a response to the client
//echo "Item added to the cart!";
?>
