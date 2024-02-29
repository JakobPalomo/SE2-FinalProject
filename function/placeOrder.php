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
        $deliveryAddress = isset($_POST['userAddress']) ? $_POST['userAddress'] : '';
        $totalPrice = isset($_POST['totalPrice']) ? $_POST['totalPrice'] : 0;  // Retrieve total price
        $paymentOption = isset($_POST['paymentOption']) ? $_POST['paymentOption'] : '';
        $deliveryOption =  isset($_POST['deliveryOption']) ? $_POST['deliveryOption'] : '';
        $preparationDate = isset($_POST['preparationDate']) ? $_POST['preparationDate'] : '';
        $deliveryTime = isset($_POST['deliveryTime']) ? $_POST['deliveryTime'] : '';
        
         // Set the status based on the payment option
         if ($paymentOption === 'Gcash') {
            $status = 'To Pay';
        } else {
            $status = 'Pending';
        }

        // Prepare the SQL statement with parameterized queries to prevent SQL injection
        $query = "INSERT INTO pending (user_session_id, name, contact, email, items, delivery_address, total_price, payment_option, delivery_option, preparation_date,delivery_time, status)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare and bind the statement
        if ($stmt = mysqli_prepare($con, $query)) {
            mysqli_stmt_bind_param($stmt, "isssssdsssss", $userSessionId, $name, $contact, $email, $items, $deliveryAddress, $totalPrice, $paymentOption, $deliveryOption, $preparationDate, $deliveryTime, $status);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                // Order placed successfully, you can perform additional actions if needed
                unset($_SESSION['cart']); // Unset the cart
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