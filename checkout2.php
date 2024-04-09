<?php
session_start();
include('dbcon.php');

// Get the ID parameter from the URL
$id = $_GET['id'];

// Retrieve the order details from the 'pending' table
$statement = $con->prepare("SELECT * FROM `pending` WHERE `id` = ?");
$statement->bind_param("i", $id);
$statement->execute();
$result = $statement->get_result();
$order = $result->fetch_assoc();

// Check if the order exists
if (!$order) {
    echo "Error: Order not found";
    exit;
}

// Extract items from the order
$items = unserialize($order['items']);

// Check if items are null before unserializing
if ($items !== false) {
    // Create the line items array
    $line_items = [];
    $total_amount = 0; // Initialize total amount
    foreach ($items as $item) {
        $item_total = $item['quantity'] * $item['sizePrice']; // Calculate total for this item
        $total_amount += $item_total; // Add to the total amount
        $line_items[] = [
            'name' => $item['productName'],
            'quantity' => $item['quantity'],
            'size' => $item['size'],
            'amount' => $item_total * 100, // Amount should be in cents
            'currency' => 'PHP',
            'description' => $item['productName'],
        ];
    }
} else {
    echo "Error: Items are null in the database";
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['paymentScreenshot']) && $_FILES['paymentScreenshot']['error'] === UPLOAD_ERR_OK) {
        // Get the file name
        $filename = $_FILES['paymentScreenshot']['name'];
        // Get the file content
        $fileContent = file_get_contents($_FILES['paymentScreenshot']['tmp_name']);

        // Update the order status to "Paid" and store the payment screenshot in the database
        $update_statement = $con->prepare("UPDATE `pending` SET `status` = 'Paid' WHERE `id` = ?");
        $update_statement->bind_param("i", $id);
        if ($update_statement->execute()) {
            // Insert the payment screenshot into the database
            $insert_statement = $con->prepare("INSERT INTO `gcashpayments` (`order_id`, `user_session_id`, `name`, `contact`, `email`, `items`, `delivery_address`, `total_price`, `payment_option`, `delivery_option`, `delivery_time`, `status`, `payment_screenshot`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_statement->bind_param("issssssdsssss", $order_id, $user_session_id, $name, $contact, $email, $items, $delivery_address, $total_price, $payment_option, $delivery_option, $delivery_time, $status, $filename);
            $order_id = $id;
            $user_session_id = $_SESSION['auth_user']['id']; // Updated key
            $name = $_SESSION['auth_user']['fname'] . ' ' . $_SESSION['auth_user']['lname']; // Updated keys
            $contact = $_SESSION['auth_user']['contact']; // Updated key
            $email = $_SESSION['auth_user']['email']; // Updated key
            $items = serialize($items);
            $delivery_address = $_SESSION['auth_user']['address']; // Updated key
            $total_price = $total_amount;
            $payment_option = 'Gcash';
            $delivery_option = 'Delivery';
            $delivery_time = $order['delivery_time'];
            $status = 'Paid';

            if ($insert_statement->execute()) {
                // Upload the file
                $uploadFileDir = 'admin/payments/';
                $dest_path = $uploadFileDir . $filename;
                if(move_uploaded_file($_FILES['paymentScreenshot']['tmp_name'], $dest_path)) {
                    echo "Order status updated successfully. Payment screenshot uploaded.";
                    // Redirect to user-account.php or any other page after updating the status
                    header("Location: user-account.php");
                    exit;
                } else {
                    echo "Error uploading payment screenshot file.";
                }
            } else {
                echo "Error inserting payment screenshot: " . $con->error;
            }
        } else {
            echo "Error updating order status: " . $con->error;
        }
    } else {
        echo "Error uploading payment screenshot.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/navbar.css" />
    <link rel="stylesheet" href="css/menupageStyle.css" />
    <link rel="shortcut icon" type="x-icon" href="./img/logomini.png">
    <link rel="stylesheet" type="text/css" href="css/menuelement.css" />
    <title>Checkout</title>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="https://kit.fontawesome.com/0f6618b60b.js" crossorigin="anonymous"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Inika&family=Plus+Jakarta+Sans&display=swap"
      rel="stylesheet"
    />
  </head>
  <body style="background-color: #f5f5dc">
  <?php include('common/navbar.php');?>
<div class="contain">
  <div class="checkout">
<div class="container mt-5">
        <h2 class="Details-head">Order Details</h2>
        <p class="Details"><strong>Order ID:</strong> <?php echo $order['id']; ?></p>
        <p class="Details"><strong>Total Amount: <?php echo number_format($total_amount, 2); ?> PHP</strong></p>
        <hr>
        <h3 class="Details">Items:</h3>
        <ul class="detail-list" style="background-color: whitesmoke;">
            <?php foreach ($line_items as $item): ?>
                <li>
                    <p class="Details"><strong>Name:</strong> <?php echo $item['name']; ?></p>
                    <p class="Details"><strong>Size:</strong> <?php echo $item['size']; ?></p>
                    <p class="Details"><strong>Quantity:</strong> <?php echo $item['quantity']; ?></p>
                    <p class="Details"><strong>Amount:</strong> <?php echo number_format($item['amount'] / 100, 2); ?> PHP</p>
                    <p class="Details"><strong>Description:</strong> <?php echo $item['description']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <!-- End Order Details -->

    <!-- Image and Button Section -->
    <div class="contain">
        
        
        <!-- Button -->
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="paymentScreenshot" accept="image/*">
            <button type="submit" name="paid" class="pay" style="margin-bottom: 12px;"><i class="fa-solid fa-money-bill-wave" style="color:#004225;"></i> Upload Payment Screenshot</button>
        </form>

</div>
        <!-- Image --></div>
        <p class="Details">Use This Gcash Number/QR code to pay</p>
        <img src="img/Gcash.jpg" alt="Your Image" style="width: 100%; max-width: 500px; height: auto;">
    

</div>
    <!-- Order Details -->
    
  </body>
</html>
