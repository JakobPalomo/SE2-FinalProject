<?php
session_start();
include('../dbcon.php');
require '../vendor/autoload.php'; // Include PHPMailer autoload file

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    
    // Check if the order belongs to the authenticated user
    $user_id = $_SESSION['auth_user']['id'];
    $query = "SELECT * FROM pending WHERE id = ? AND user_session_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $order_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows == 1) {
        // Fetch the order details
        $row = $result->fetch_assoc();
        $userEmail = $row['email'];
        $status = $row['status'];
        $name = $row['name']; 
        $contact = $row['contact'];
        $email = $row['email'];
        $items = $row['items'];
        $deliveryAddress = $row['delivery_address'];
        $totalPrice = $row['total_price'];
        $paymentOption = $row['payment_option'];
        $deliveryOption = $row['delivery_option'];
        $preparationDate = $row['preparation_date'];
        $deliveryTime = $row['delivery_time'];

        // Update order status to "Cancelled"
        $query = "UPDATE pending SET status = 'Cancelled' WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $order_id);
        if($stmt->execute()) {
            echo "Order cancelled successfully.";
            sendCancellationEmailToUser($userEmail, $status);
            sendCancellationEmailToAdmin($name, $contact, $email, $items, $deliveryAddress, $totalPrice, $paymentOption, $deliveryOption, $preparationDate, $deliveryTime, $status);
        } else {
            echo "Failed to cancel the order.";
        }
    } else {
        echo "Unauthorized access or order not found.";
    }
} else {
    echo "Invalid request.";
}

function sendCancellationEmailToUser($userEmail, $status) {
    $mail = new PHPMailer(true);

    // Set mail parameters
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ezequielg070901@gmail.com';
    $mail->Password = 'zmxy twtu fuym ejjs';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('ezequielg070901@gmail.com', "Chef's Daughter");
    $mail->addAddress($userEmail);
    $mail->isHTML(true);
    $mail->Subject = 'Your Order Has Been Cancelled';
    
    // Email content based on order status
    if ($status === 'Pending') {
        $emailContent = "Your order has been cancelled. We couldn't get to your request in time. (Busy / Unavailable) Try to order some other time.";
    } elseif ($status === 'To Pay') {
        $emailContent = "Your order has been cancelled. Order wasn't paid within 3 days.";
    } else {
        $emailContent = "Your order has been cancelled.";
    }
    
    $mail->Body = $emailContent;

    // Send email
    try {
        $mail->send();
        // echo "Cancellation email sent successfully to $userEmail.";
    } catch (Exception $e) {
        // echo "Failed to send cancellation email to $userEmail: " . $mail->ErrorInfo;
    }
}

function sendCancellationEmailToAdmin($name, $contact, $email, $items, $deliveryAddress, $totalPrice, $paymentOption, $deliveryOption, $preparationDate, $deliveryTime, $status) {
    $mail = new PHPMailer(true);

    // Set mail parameters
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ezequielg070901@gmail.com';
    $mail->Password = 'zmxy twtu fuym ejjs';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('ezequielg070901@gmail.com', "Chef's Daughter");
    $mail->addAddress('ezequielg070901@gmail.com');
    $mail->isHTML(true);
    $mail->Subject = 'Order Cancelled by User';

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

    $email_template = "<h1>Order Cancelled by $name</h1>
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

    // Send email
    try {
        $mail->send();
        // echo "Cancellation email sent successfully to admin.";
    } catch (Exception $e) {
        // echo "Failed to send cancellation email to admin: " . $mail->ErrorInfo;
    }
}
?>
