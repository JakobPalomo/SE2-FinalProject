<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';
include_once 'include/config.php';

if(strlen($_SESSION['alogin']) == 0) { 
    header('location:index.php');
    exit(); // Stop further execution
}

$oid = intval($_GET['oid']);

// Fetch order list from the database
$statement = $con->prepare("SELECT * FROM `pending` WHERE `id` = ?");
$statement->bind_param("i", $oid);
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
            'amount' => $item_total * 100, // Amount should be in cents
            'currency' => 'PHP',
            'description' => $item['productName'],
        ];
    }
} else {
    echo "Error: Items are null in the database";
    exit;
}

if(isset($_POST['submit2'])) {
    $status = $_POST['status'];
    $remark = $_POST['remark'];

    // Insert order tracking history
    $query = mysqli_query($con, "INSERT INTO ordertrackhistory(orderId,status,remark) VALUES('$oid','$status','$remark')");

    if($query) {
        // Update order status
        $sql = mysqli_query($con, "UPDATE pending SET status='$status' WHERE id='$oid'");

        if($sql) {
            // Order updated successfully
            echo "<script>alert('Order updated successfully...');</script>";

            // Check if the status is "Declined"
            if ($status == "Declined") {
                // Fetch user email associated with the order
                $getUserEmailQuery = mysqli_query($con, "SELECT email FROM users WHERE id IN (SELECT user_session_id FROM pending WHERE id='$oid') LIMIT 1");
                $userEmailRow = mysqli_fetch_array($getUserEmailQuery);
                $userEmail = $userEmailRow['email'];

                // Send email to the user
                $mail = new PHPMailer(true);

                try {
                    // SMTP configuration
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'cdemailverify@gmail.com'; // Your Gmail email address
                    $mail->Password = 'imse cgjh qyzq bwhg'; // Your Gmail password
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    // Sender and recipient settings
                    $mail->setFrom("cdemailverify@gmail.com", "Chef's Daughter");
                    $mail->addAddress($userEmail);

                    // Email content
                    $mail->isHTML(true);
                    $mail->Subject = 'Order Declined';
                    $mail->Body = 'Sorry, we have declined your order.';

                    // Send email
                    $mail->send();
                    echo "<script>alert('Email sent to user: Order Declined');</script>";
                } catch (Exception $e) {
                    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        } else {
            // Error occurred while updating order
            echo "<script>alert('Error updating order');</script>";
        }
    } else {
        // Error occurred while inserting order tracking history
        echo "<script>alert('Error inserting order tracking history');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Update Order</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/navbar.css" />
    <link rel="stylesheet" type="text/css" href="../css/card.css" />
    <link rel="stylesheet" type="text/css" href="../css/updateorder.css" />
    <title>Document</title>
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inika&family=Plus+Jakarta+Sans&display=swap"
      rel="stylesheet"
    />
<link href="css/update.css" rel="stylesheet" type="text/css">
<link
      href="https://fonts.googleapis.com/css2?family=Inika&family=Plus+Jakarta+Sans&display=swap"
      rel="stylesheet"
    />
</head>
<body>

<div style="margin-left:18%; margin-right:18%;">
<form name="updateticket" id="updateticket" method="post">
<div class="card-field">
      <div class="card-place" style=" margin-bottom: 20%;``">
        
        <div class="card-title"><h1>Update Order</h1></div>
        <!-- Place Content of card here -->
        <p class="order" style="margin-top: 12px; text-decoration: underline;">Order No. <?php echo $oid;?></p>
        <table width="50%" cellspacing="0" cellpadding="0" style="margin-left: 24px;">
        <?php 
    $ret = mysqli_query($con,"SELECT * FROM ordertrackhistory WHERE orderId='$oid'");
    while($row=mysqli_fetch_array($ret)) {
    ?>
    <tr height="20">
      <td class="fontkink1" style="margin-left: 12px;" ><b>At Date:</b></td>
      <td  class="fontkink"><?php echo $row['postingDate'];?></td>
    </tr>
    <tr height="20">
      <td  class="fontkink1"><b>Status:</b></td>
      <td  class="fontkink"><?php echo $row['status'];?></td>
    </tr>
    <tr height="20">
      <td  class="fontkink1"><b>Remark:</b></td>
      <td  class="fontkink"><?php echo $row['remark'];?></td>
    </tr>
    <tr>
      <td colspan="2"><hr /></td>
    </tr>
    <?php } ?>
        </table>

        <!-- Order Details -->
                            <div class="container mt-5">
                                <h2 class="Details-head">Order Details</h2>
                                <p class="Details"><strong>Total Amount: <?php echo number_format($total_amount, 2); ?> PHP</strong></p>
                                <hr>
                                <h3 class="Details">Items:</h3>
                                <ul class="detail-list" style="background-color: whitesmoke;">
                                    <?php foreach ($line_items as $item): ?>
                                      <br>
                                        <li>
                                            <p class="Details"><strong>Name:</strong> <?php echo $item['name']; ?></p>
                                            <p class="Details"><strong>Quantity:</strong> <?php echo $item['quantity']; ?></p>
                                            <p class="Details"><strong>Amount:</strong> <?php echo number_format($item['amount'] / 100, 2); ?> PHP</p>
                                            <p class="Details"><strong>Description:</strong> <?php echo $item['description']; ?></p>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                    <!-- End Order Details -->

 
        
        <div class="status">
        <?php 
    $st = 'Delivered';
    $rt = mysqli_query($con,"SELECT * FROM pending WHERE id='$oid'");
    while($num=mysqli_fetch_array($rt)) {
        $currrentSt=$num['status'];
    }
    if($st == $currrentSt) { ?>
        <tr><td colspan="2"><b>Product Delivered </b></td>
    <?php } else  { ?>
          <label for="statusDropdown" class="status">Status:</label>
          <select class="drop" class="status" name="status" id="statusDropdown" required>
          <option value="">Select Status</option>
                      <option value="Accepted">Accepted</option>
                      <option value="To Pay">Pay Online</option>
                      <option value="Delivered">Delivered</option>
                      <option value="Declined">Declined</option>
          </select>
        </div>

        <p class="status" style="padding-left: 24px;">Remarks</p>
        <textarea class="remarks-box" name="remark"></textarea>

        <div class="button">
          <input type="submit" value="Update" class="add-item" name="submit2" />
          <input type="submit" value="Cancel" class="add-item" name="Submit2" onClick="closeTab();" />

<script>
    function closeTab() {
        window.close();
    }
</script>

        </div>    <?php } ?>
        <!-- End of content card -->
      </div>
      </form>
    </div>




<!-- PREVIOUS UPDATE -->

<!-- 
 <form name="updateticket" id="updateticket" method="post"> 
<table width="50%" border="0" cellspacing="0" cellpadding="0">
    <tr height="50">
      <td colspan="2" class="fontkink2" style="padding-left:0px;height: 60%;">
          <div class="fontpink2" style=" background-color: #004225; height: 36px;  color: #f0f0f0;  text-align: center; border-radius: 12px;"> <b>Update Order !</b></div>
      </td>
    </tr>
    <tr height="30">
      <td  class="fontkink1"><b>Order Id:</b></td>
      <td  class="fontkink"><?php echo $oid;?></td>
    </tr>
    <?php 
    $ret = mysqli_query($con,"SELECT * FROM ordertrackhistory WHERE orderId='$oid'");
    while($row=mysqli_fetch_array($ret)) {
    ?>
    <tr height="20">
      <td class="fontkink1" ><b>At Date:</b></td>
      <td  class="fontkink"><?php echo $row['postingDate'];?></td>
    </tr>
    <tr height="20">
      <td  class="fontkink1"><b>Status:</b></td>
      <td  class="fontkink"><?php echo $row['status'];?></td>
    </tr>
    <tr height="20">
      <td  class="fontkink1"><b>Remark:</b></td>
      <td  class="fontkink"><?php echo $row['remark'];?></td>
    </tr>
    <tr>
      <td colspan="2"><hr /></td>
    </tr>
    <?php } ?>
    <?php 
    $st = 'Delivered';
    $rt = mysqli_query($con,"SELECT * FROM pending WHERE id='$oid'");
    while($num=mysqli_fetch_array($rt)) {
        $currrentSt=$num['status'];
    }
    if($st == $currrentSt) { ?>
        <tr><td colspan="2"><b>Product Delivered </b></td>
    <?php } else  { ?>
        <tr height="50">
          <td class="fontkink1">Status: </td>
          <td  class="fontkink">
              <span class="fontkink1">
                  <select name="status" class="fontkink" required="required" >
                      <option value="">Select Status</option>
                      <option value="Accepted">Accepted</option>
                      <option value="To Pay">Pay Online</option>
                      <option value="Delivered">Delivered</option>
                      <option value="Declined">Declined</option>
                  </select>
              </span>
          </td>
        </tr>
        <tr style=''>
          <td class="fontkink1" >Remark:</td>
          <td class="fontkink" >
              <span class="fontkink">
              <textarea cols="50" rows="6" name="remark" required="required" style="border-radius: 8px; font-family: 'Jakarta Sans', sans-serif; padding: 12px;"></textarea>

              </span>
          </td>
        </tr>
        <tr>
          <td class="fontkink1">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="fontkink"></td>
          <td class="fontkink">
              <input type="submit" name="submit2" value="Update" size="40" style="cursor: pointer;border-radius: 8px;" />
              &nbsp;&nbsp;   
              <input name="Submit2" type="submit" class="txtbox4" value="Close this Window " onClick="return f2();" style="cursor: pointer;border-radius: 8px;"  />
          </td>
        </tr>
    <?php } ?>
</table>
 </form>
</div> -->

</body>
</html>
