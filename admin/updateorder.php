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
<link href="css/update.css" rel="stylesheet" type="text/css">
<link
      href="https://fonts.googleapis.com/css2?family=Inika&family=Plus+Jakarta+Sans&display=swap"
      rel="stylesheet"
    />
</head>
<body>

<div style="margin-left:18%; margin-right:18%;">
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
</div>

</body>
</html>
