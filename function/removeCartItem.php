<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['index'])) {
    $index = $_POST['index'];

    // Remove the item from the cart in the session
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        // Optional: Reindex the array to prevent gaps in the indexes
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    // You can optionally return a response to the client
    echo "Item removed from the cart!";
} else {
    // Invalid request
    header("HTTP/1.0 400 Bad Request");
    echo "Invalid request";
}
?>