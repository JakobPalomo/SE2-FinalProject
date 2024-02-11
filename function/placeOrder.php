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
        $name = $_SESSION['auth_user']['fname'] . " " . $_SESSION['auth_user']['lname']; // Concatenate using dot (.)
        $contact = $_SESSION['auth_user']['contact']; // Assuming contact details are stored separately
        $email = $_SESSION['auth_user']['email'];
        $deliveryAddress = $_SESSION['auth_user']['address'];
        $totalPrice = isset($_POST['totalPrice']) ? $_POST['totalPrice'] : 0;  // Retrieve total price
        $paymentOption = isset($_POST['paymentOption']) ? $_POST['paymentOption'] : '';
        $deliveryOption = isset($_POST['deliveryCheckbox']) ? 'Delivery' : (isset($_POST['pickupCheckbox']) ? 'Pickup' : '');
        $preparationDate = isset($_POST['preparationDate']) ? $_POST['preparationDate'] : '';

        // Prepare the SQL statement with parameterized queries to prevent SQL injection
        $query = "INSERT INTO pending (user_session_id, name, contact, email, items, delivery_address, total_price, payment_option, delivery_option, preparation_date)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare and bind the statement
        if ($stmt = mysqli_prepare($con, $query)) {
            mysqli_stmt_bind_param($stmt, "isssssdsss", $userSessionId, $name, $contact, $email, $items, $deliveryAddress, $totalPrice, $paymentOption, $deliveryOption, $preparationDate);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                // Order placed successfully, you can perform additional actions if needed
                echo "Order placed successfully!";
            } else {
                echo "Error placing order: " . mysqli_stmt_error($stmt);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($con);
        }
    } else {
        echo "Your cart is empty. Cannot place an empty order.";
    }
}


// Call the placeOrder function
placeOrder();
?>
