<?php
session_start();
include('../dbcon.php');

function placeOrder() {
    global $con;

    if (!empty($_SESSION['cart'])) {
        // Get user session ID
        $userSessionId = $_SESSION['auth_user']['id'];

        // Serialize the items array
        $items = serialize($_SESSION['cart']);

        // Get other order details
        $deliveryAddress = $_SESSION['auth_user']['address'];
        $totalPrice = isset($_POST['totalPrice']) ? $_POST['totalPrice'] : 0;  // Retrieve total price
        $paymentOption = isset($_POST['paymentOption']) ? $_POST['paymentOption'] : '';
        $deliveryOption = isset($_POST['deliveryCheckbox']) ? 'Delivery' : (isset($_POST['pickupCheckbox']) ? 'Pickup' : '');
        $preparationDate = isset($_POST['preparationDate']) ? $_POST['preparationDate'] : '';

        // Insert into the orders table
        $query = "INSERT INTO orders (user_session_id, items, delivery_address, total_price, payment_option, delivery_option, preparation_date)
                  VALUES ('$userSessionId', '$items', '$deliveryAddress', $totalPrice, '$paymentOption', '$deliveryOption', '$preparationDate')";

        if (mysqli_query($con, $query)) {
            // Order placed successfully, you can perform additional actions if needed
            echo "Order placed successfully!";
        } else {
            echo "Error placing order: " . mysqli_error($con);
        }
    } else {
        echo "Your cart is empty. Cannot place an empty order.";
    }
}

// Call the placeOrder function
placeOrder();
?>
