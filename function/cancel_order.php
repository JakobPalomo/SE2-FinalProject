<?php
session_start();
include('../dbcon.php');

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
        // Update order status to "Cancelled"
        $query = "UPDATE pending SET status = 'Cancelled' WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $order_id);
        if($stmt->execute()) {
            echo "Order cancelled successfully.";
        } else {
            echo "Failed to cancel the order.";
        }
    } else {
        echo "Unauthorized access or order not found.";
    }
} else {
    echo "Invalid request.";
}
?>
