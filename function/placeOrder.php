<?php
require '../vendor/autoload.php'; // Include PHPMailer autoload file
session_start();
include('../dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function placeOrder() {
    global $con;
    $response = "";

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
        $status = 'Pending';

        // Get the current date and time
        $currentDateTime = date('Y-m-d H:i:s'); // Format: YYYY-MM-DD HH:MM:SS
        
        // Prepare the SQL statement with parameterized queries to prevent SQL injection
        $query = "INSERT INTO pending (user_session_id, name, contact, email, items, delivery_address, total_price, payment_option, delivery_option, preparation_date, delivery_time, status, created_at)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare and bind the statement
        if ($stmt = mysqli_prepare($con, $query)) {
            mysqli_stmt_bind_param($stmt, "isssssdssssss", $userSessionId, $name, $contact, $email, $items, $deliveryAddress, $totalPrice, $paymentOption, $deliveryOption, $preparationDate, $deliveryTime, $status, $currentDateTime);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                // Order placed successfully, you can perform additional actions if needed
                unset($_SESSION['cart']); // Unset the cart

                // Send order email
                sendOrderEmail($name, $contact, $email, $items, $deliveryAddress, $totalPrice, $paymentOption, $deliveryOption, $preparationDate, $deliveryTime, $status);

                $response = "Order placed successfully!";
            } else {
                echo "Error placing order: " . mysqli_stmt_error($stmt);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($con);
        }
    } else {
        $response = "Your cart is empty. Cannot place an empty order.";
    }

    return $response;
}

function sendOrderEmail($name, $contact, $email, $items, $deliveryAddress, $totalPrice, $paymentOption, $deliveryOption, $preparationDate, $deliveryTime, $status) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();   
    $mail->SMTPAuth   = true;                             
    $mail->Host       = 'smtp.gmail.com';                                    
    $mail->Username   = 'ezequielg070901@gmail.com';                    
    $mail->Password   = 'zmxy twtu fuym ejjs';       
    $mail->SMTPSecure = "tls";   
    $mail->Port       = 587;           
    $mail->setFrom("ezequielg070901@gmail.com", "Chef's Daughter"); // Corrected the From address
    $mail->addAddress('ezequielg070901@gmail.com'); // Receiver's email address

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'New Order Received';

    // Unserialize the items array
    $itemsArray = unserialize($items);

    // Format items as a list
    $itemsList = "<ul>";
    foreach ($itemsArray as $item) {
        $itemsList .= "<li>";
        $itemsList .= "Product ID: " . $item['productId'] . "<br>";
        $itemsList .= "Product Name: " . $item['productName'] . "<br>";
        $itemsList .= "Quantity: " . $item['quantity'] . "<br>";
        $itemsList .= "Size: " . $item['size'] . "<br>";
        $itemsList .= "Size Price: " . $item['sizePrice'] . "<br>";
        $itemsList .= "Total Price: " . $item['totalPrice'] . "<br>";
        $itemsList .= "</li>";
    }
    $itemsList .= "</ul>";

    $email_template = "<h1>New Order Received</h1>
    <h2>Name: $name</h2>
    <h2>Contact: $contact</h2>
    <h2>Email: $email</h2>
    <h2>Items:</h2>
    $itemsList
    <h2>Delivery Address: $deliveryAddress</h2>
    <h2>Total Price: $totalPrice</h2>
    <h2>Payment Option: $paymentOption</h2>
    <h2>Delivery Option: $deliveryOption</h2>
    <h2>Preparation Date: $preparationDate</h2>
    <h2>Delivery Time: $deliveryTime</h2>
    <h2>Status: $status</h2>";

    $mail->Body = $email_template;

  
    error_log("Email template: " . $email_template);

   if(!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        //echo "A Message has been sent to the owner";
     }
}



// Call the placeOrder function and get the response
$responseMessage = placeOrder();

// Echo the response message
echo $responseMessage;
?>
