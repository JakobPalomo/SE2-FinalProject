<?php
require '../vendor/autoload.php'; // Include PHPMailer autoload file
include('../dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function cancelPendingOrders() {
    global $con;

    // Get the current time
    $currentTime = time();
    $cancelWindow = 10; // 2 hours in seconds

    // Calculate the time 2 hours ago
    $cancelTime = $currentTime - $cancelWindow;

    // Format the cancel time to match the MySQL datetime format
    $cancelTimeFormatted = date('Y-m-d H:i:s', $cancelTime);

    // Prepare and execute the SQL query to update orders with status "Pending" and "To Pay" older than 2 hours
    $query = "UPDATE pending SET status = 'Cancelled' WHERE (status = 'Pending' OR status = 'To Pay') AND created_at <= ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $cancelTimeFormatted);
    if ($stmt->execute()) {
       // echo "Pending and To Pay orders older than 2 hours have been cancelled successfully.";

        // Fetch the details of the canceled orders
        $cancelledOrdersQuery = "SELECT * FROM pending WHERE status = 'Cancelled' AND created_at <= ?";
        $cancelledOrdersStmt = $con->prepare($cancelledOrdersQuery);
        $cancelledOrdersStmt->bind_param("s", $cancelTimeFormatted);
        $cancelledOrdersStmt->execute();
        $result = $cancelledOrdersStmt->get_result();

        // Loop through the cancelled orders and send email notifications to the users
        while ($row = $result->fetch_assoc()) {
            $userEmail = $row['email'];
            $status = $row['status'];
            sendCancellationEmail($userEmail, $status);
        }
    } else {
       // echo "Error cancelling pending and To Pay orders: " . $stmt->error;
    }
}

function sendCancellationEmail($userEmail, $status) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'cdemailverify@gmail.com'; // Your Gmail email address
    $mail->Password = 'imse cgjh qyzq bwhg'; // Your Gmail password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

     // Sender and recipient settings
    $mail->setFrom("cdemailverify@gmail.com", "Chef's Daughter");
    $mail->addAddress($userEmail); // Receiver's email address

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Your Order Has Been Cancelled';

    $emailContent = '';

    if ($status === 'Pending') {
        $emailContent = "Your order has been cancelled. We couldn't get to your request in time. (Busy / Unavailable) Try to order some other time.";
    } elseif ($status === 'To Pay') {
        $emailContent = "Your order has been cancelled. Order wasn't paid within 3 days.";
    } else {
        $emailContent = "Your order has been cancelled.";
    }

    $mail->Body = $emailContent;

    // if(!$mail->send()) {
    //     echo "Failed to send cancellation email to $userEmail: " . $mail->ErrorInfo;
    // } else {
    //     echo "Cancellation email sent successfully to $userEmail.";
    // }
}

