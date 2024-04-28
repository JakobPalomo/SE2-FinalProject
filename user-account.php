<?php
session_start();
include('dbcon.php');

// Check if the user is authenticated, if not, redirect to the login page
if (!isset($_SESSION['authenticated'])) {
    header("Location: index.php"); // Replace 'login.php' with the actual login page
    exit(); 
}

// Fetch user data from the database
$user_id = $_SESSION['auth_user']['id'];
$query = "SELECT fname, lname, address, email, contact FROM users WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $fname = $row['fname'];
    $lname = $row['lname'];
    $address = $row['address'];
    $email = $row['email'];
    $contact = $row['contact'];
} else {
    // User not found, handle error (redirect, display message, etc.)
    exit("Error: User not found");
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/navbar.css" />
    <link rel="stylesheet" type="text/css" href="css/card.css" />
    <link rel="shortcut icon" type="x-icon" href="./img/logomini.png">
    <link rel="stylesheet" type="text/css" href="css/lectercard.css" />
    <link rel="stylesheet" type="text/css" href="css/pendingordercard.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <title>My Account</title>
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
    <link rel="stylesheet" href="css/w3.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="https://kit.fontawesome.com/0f6618b60b.js" crossorigin="anonymous"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Inika&family=Plus+Jakarta+Sans&display=swap"
      rel="stylesheet"
    />
  </head>
  <body style="background-color: #f5f5dc; margin-top:5px;">

  <style>
  /* Hide all card-fields except the first one */
  .card-field {
    display: none;
  }
  #card1 {
    display: flex; /* Show the first card by default */
  }
</style>

    <?php $includeButton = true; ?>
    <?php $includeFixedTop = true; ?>
    <?php include('common/navbar.php');?>
   

    <!-- Code zone -->
    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" id="mySidebar">
  <center><button class="add-item mt-5" style=" padding-bottom: 34px;margin-bottom:12px;  white-space: wrap;" onclick="redirectToCategory()"> <i class="fa-solid fa-utensils" style="color: #004225;"></i>  Order Now</button></center>
  <a href="#" class="w3-bar-item w3-button show-card" data-target="card1"><span><img src="./img/profile.png" class="icon" />
</span>My Profile</a>
  <a href="#" class="w3-bar-item w3-button show-card" data-target="card2">
    <span><img src="./img/utensils.png" class="icon" /></span>Pending Order</a>
    <a href="#" class="w3-bar-item w3-button show-card" data-target="card5">
    <span><i class="fa-solid fa-sack-dollar" style="color: #000000;margin-right: 21px;"></i></span>To Pay</a>
  <a href="#" class="w3-bar-item w3-button show-card" data-target="card3">
    <span><img src="./img/biking-mountain.png" class="icon"/></span>Accepted Orders</a>
  <a href="#" class="w3-bar-item w3-button show-card" data-target="card4">
    <span><img src="./img/list-check.png" class="icon" /></span>Past Orders</a>
  <a href="./logout.php" class="w3-bar-item w3-button">
    <span><img src="./img/sign-out-alt.png" class="icon" /></span>Logout</a>
 
</div>

    <script>
  function redirectToCategory() {
    window.location.href = 'subcategory.php?scid=1';
  }
    </script>

<script>
    $(document).ready(function() {
        $('.order-row').click(function() {
            $($(this).data('target')).modal('show');
        });
    });
</script>

<script>
  $(document).ready(function() {
    $('.cancel-order-btn').click(function() {
        var orderId = $(this).data('order-id');
        $.ajax({
            url: './function/cancel_order.php',
            type: 'POST',
            data: { order_id: orderId },
            success: function(response) {
                alert(response); // Display success or error message
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Error: " + xhr.responseText); // Display error message
            }
        });
    });
});
  </script>


    <div class="dashboard" id="main">
      <div class="card-field" id="card1">
        <div class="card-place" style="height: max-content;">
          <div class="card-title"><h1>My Profile</h1></div>
          <!-- Place Content of card here -->
          <div class="inner-card">
  <table class="details">
    <tr>
      <td>
        <div class="column-container">
          <img src="./img/nameicon.png" alt="Name Image" />
          <div class="info-container">
            <p class="info-label">Name</p>
            <p class="info"><?php echo $fname . ' ' . $lname; ?></p>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="column-container">
          <img src="./img/addressicon.png" alt="Address Image" />
          <div class="info-container">
            <p class="info-label">Address</p>
            <p class="info"><?php echo $address; ?></p>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="column-container">
          <img src="./img/emailicon.png" alt="Email Image" />
          <div class="info-container">
            <p class="info-label">Email</p>
            <p class="info"><?php echo $email; ?></p>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="column-container">
          <img src="./img/contactnoicon.png" alt="Contact Number Image" />
          <div class="info-container">
            <p class="info-label">Contact number</p>
            <p class="info"><?php echo $contact; ?></p>
          </div>
        </div>
      </td>
    </tr>
  </table>
  
  <center>
  <a style="color: white;" href="editaccount.php">
    <button class="add-item mt-5" style="padding-bottom: 34px; margin-bottom: 12px; white-space: wrap;">
      <i class="fa-solid fa-user-edit" style="color: #004225;"></i> Edit Profile
    </button>
  </a>

  <a href="changepassword.php">
            <button class="add-item mt-3" style="padding-bottom: 34px; margin-bottom: 12px; white-space: wrap;">
              <i class="fa-solid fa-lock" style="color: #004225;"></i> Change Password
            </button>
          </a>
</center>

</div>

          <!-- End of content card -->
        </div>
      </div>

      <?php
        $user_id = $_SESSION['auth_user']['id'];
        $query = "SELECT * FROM pending WHERE user_session_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $orders = array(); // Store the results in an array
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
      ?>

<div class="card-field" id="card2">
    <div class="card-place">
        <div class="card-title"><h1>Pending Orders</h1></div>
        <div class="pending-order-container" style="flex-grow: 1; overflow-y: auto;">
            <?php if (empty($orders)): ?>
                <div class="orderstat" style="text-align: center;">No Orders Found</div>
            <?php else: ?>
                <table class="table-order">
                    <?php foreach ($orders as $row):
                        $orderId = $row['id'];
                        $orderStatus = $row['status'];
                        $deliveryDate = $row['preparation_date'];
                        $deliveryTime = $row['delivery_time'];
                        $deliveryOption = $row['delivery_option'];
                        $paymentOption = $row['payment_option'];
                        $deliveryAddress = $row['delivery_address'];
                        $orderTime = strtotime($row['created_at']);
                        $orderItems = unserialize($row['items']);

                        // Check if order status is "Pending"
                        if ($orderStatus === "Pending"):
                    ?>
                            <tr class="order-row" data-toggle="modal" data-target="#orderModal_<?php echo $orderId; ?>">
                                <td class="orderno">Order No. <?php echo $orderId; ?></td>
                                <td class="orderstat"><?php echo $orderStatus; ?></td>
                            </tr>
                            <td class="cancel-button">
                                  <?php 
                                  // Check if the order is still within the 2-hour window for cancellation
                                  $currentTime = time();
                                  $orderTime = strtotime($row['created_at']);
                                  $timeDiff = $currentTime - $orderTime;
                                  $cancelWindow = 1 * 24 * 60 * 60; //1day
                                  if ($timeDiff <= $cancelWindow): ?>
                                      <button class="cancel-order-btn" data-order-id="<?php echo $orderId; ?>">Cancel Order</button>
                                  <?php endif; ?>
                              </td>
                            <?php
                            $lastItemKey = array_key_last($orderItems);
                            $subtotal = 0;
                            foreach ($orderItems as $key => $item):
                                $quantity = $item['quantity'];
                                $itemName = $item['productName'];
                                $itemPrice = $item['sizePrice'];
                                $totalPrice = $quantity * $itemPrice; 
                                $subtotal += $totalPrice; 
                            ?>
                                <tr<?php if ($key === $lastItemKey) echo " style='margin-bottom: 24px;'"; ?>>
                                    <td class="ordername">x <?php echo $quantity . ' ' . $itemName; ?></td>
                                    <td class="orderprice">₱<?php echo $totalPrice; ?></td>
                                    <td class="orderprice">&nbsp;</td>
                                </tr>
                            <?php endforeach; ?>
                                    <tr>
                                      <br>
                                      <td class="orderprice">&nbsp;</td>
                                      <td class="orderprice">Total: ₱<?php echo $subtotal; ?></td>
                                   </tr>
                                   <?php if ($key === $lastItemKey): ?>
                                    <tr><td colspan="2"><hr style="border-top: 2px solid black;"></td></tr>
                                <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

    <div class="card-field" id="card3">
    <div class="card-place">
        <div class="card-title"><h1>Accepted Orders</h1></div>
        <div class="pending-order-container" style="flex-grow: 1; overflow-y: auto;">
            <?php if (empty($orders)): ?>
                <div class="orderstat" style="text-align: center;">No Orders Found</div>
            <?php else: ?>
                <table class="table-order">
                    <?php foreach ($orders as $row):
                        $orderId = $row['id'];
                        $orderStatus = $row['status'];
                        $deliveryDate = $row['preparation_date'];
                        $deliveryTime = $row['delivery_time'];
                        $deliveryOption = $row['delivery_option'];
                        $paymentOption = $row['payment_option'];
                        $deliveryAddress = $row['delivery_address'];
                        $orderItems = unserialize($row['items']);

                        
                        if ($orderStatus === "Accepted"):
                    ?>
                            <tr class="order-row" data-toggle="modal" data-target="#orderModal_<?php echo $orderId; ?>">
                                <td class="orderno">Order No. <?php echo $orderId; ?></td>
                                <td class="orderstat"><?php echo $orderStatus; ?></td>
                            </tr>
                            <?php
                            $lastItemKey = array_key_last($orderItems);
                            $subtotal = 0;
                            foreach ($orderItems as $key => $item):
                                $quantity = $item['quantity'];
                                $itemName = $item['productName'];
                                $itemPrice = $item['sizePrice'];
                                $totalPrice = $quantity * $itemPrice; 
                                $subtotal += $totalPrice; 
                            ?>
                                <tr<?php if ($key === $lastItemKey) echo " style='margin-bottom: 24px;'"; ?>>
                                    <td class="ordername">x <?php echo $quantity . ' ' . $itemName; ?></td>
                                    <td class="orderprice">₱<?php echo $totalPrice; ?></td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endforeach; ?>
                                   <tr>
                                      <br>
                                      <td class="orderprice">&nbsp;</td>
                                      <td class="orderprice">Total: ₱<?php echo $subtotal; ?></td>
                                   </tr>
                                   <?php if ($key === $lastItemKey): ?>
                                    <tr><td colspan="2"><hr style="border-top: 2px solid black;"></td></tr>
                                   <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

    <div class="card-field" id="card4">
    <div class="card-place">
        <div class="card-title"><h1>Past Orders</h1></div>
        <div class="pending-order-container" style="flex-grow: 1; overflow-y: auto;">
            <?php if (empty($orders)): ?>
                <div class="orderstat" style="text-align: center;">No Orders Found</div>
            <?php else: ?>
                <table class="table-order">
                    <?php foreach ($orders as $row):
                        $orderId = $row['id'];
                        $orderStatus = $row['status'];
                        $deliveryDate = $row['preparation_date'];
                        $deliveryTime = $row['delivery_time'];
                        $deliveryOption = $row['delivery_option'];
                        $paymentOption = $row['payment_option'];
                        $deliveryAddress = $row['delivery_address'];
                        $orderItems = unserialize($row['items']);

    
                        if ($orderStatus === "Delivered"):
                    ?>
                            <tr class="order-row" data-toggle="modal" data-target="#orderModal_<?php echo $orderId; ?>">
                                <td class="orderno">Order No. <?php echo $orderId; ?></td>
                                <td class="orderstat"><?php echo $orderStatus; ?></td>
                            </tr>
                            <?php
                            $lastItemKey = array_key_last($orderItems);
                            $subtotal = 0;
                            foreach ($orderItems as $key => $item):
                                $quantity = $item['quantity'];
                                $itemName = $item['productName'];
                                $itemPrice = $item['sizePrice'];
                                $totalPrice = $quantity * $itemPrice; 
                                $subtotal += $totalPrice; 
                            ?>
                                <tr<?php if ($key === $lastItemKey) echo " style='margin-bottom: 24px;'"; ?>>
                                    <td class="ordername">x <?php echo $quantity . ' ' . $itemName; ?></td>
                                    <td class="orderprice">₱<?php echo $totalPrice; ?></td>
                                    <td class="orderprice">&nbsp;</td>
                                </tr>
                            <?php endforeach; ?>
                                   <tr>
                                      <br>
                                      <td class="orderprice">&nbsp;</td>
                                      <td class="orderprice">Total: ₱<?php echo $subtotal; ?></td>
                                   </tr>
                                   <?php if ($key === $lastItemKey): ?>
                                    <tr><td colspan="2"><hr style="border-top: 2px solid black;"></td></tr>
                                   <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="card-field" id="card5">
    <div class="card-place">
        <div class="card-title"><h1>To Pay</h1></div>
        <div class="pending-order-container" style="flex-grow: 1; overflow-y: auto;">
            <?php if (empty($orders)): ?>
                <div class="orderstat" style="text-align: center;">No Orders Found</div>
            <?php else: ?>
                <table class="table-order">
                    <?php foreach ($orders as $row):
                        $orderId = $row['id'];
                        $orderStatus = $row['status'];
                        $deliveryDate = $row['preparation_date'];
                        $deliveryTime = $row['delivery_time'];
                        $deliveryOption = $row['delivery_option'];
                        $paymentOption = $row['payment_option'];
                        $deliveryAddress = $row['delivery_address'];
                        $orderItems = unserialize($row['items']);

                        if ($orderStatus === "To Pay"):
                    ?>
                            <tr class="order-row" data-toggle="modal" data-target="#orderModal_<?php echo $orderId; ?>">
                                <td class="orderno">Order No. <?php echo $orderId; ?></td>
                                <td class="checkout-btn">
                                    <center><a href="checkout2.php?id=<?php echo $orderId; ?>" class="add-item"  style="font-size: 15px"><i class="fa-solid fa-money-bill-wave" style="color:#004225;"></i> Checkout</a></center>
                                </td>
                            </tr>
                            <?php
                            $lastItemKey = array_key_last($orderItems);
                            $subtotal = 0;
                            foreach ($orderItems as $key => $item):
                                $quantity = $item['quantity'];
                                $itemName = $item['productName'];
                                $itemPrice = $item['sizePrice'];
                                $totalPrice = $quantity * $itemPrice; 
                                $subtotal += $totalPrice; 
                            ?>
                                <tr<?php if ($key === $lastItemKey) echo " style='margin-bottom: 24px;'"; ?>>
                                    <td class="ordername">x <?php echo $quantity . ' ' . $itemName; ?></td>
                                    <td class="orderprice">₱<?php echo $totalPrice; ?></td>
                                    <td class="orderprice">&nbsp;</td>
                                </tr>
                            <?php endforeach; ?>
                                    <tr>
                                      <br>
                                      <td class="orderprice">&nbsp;</td>
                                      <td class="orderprice">Total: ₱<?php echo $subtotal; ?></td>
                                   </tr>
                                   <?php if ($key === $lastItemKey): ?>
                                    <tr><td colspan="2"><hr style="border-top: 2px solid black;"></td></tr>
                                   <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>


        <!-- Add more card-fields with unique ids -->
    </div>

    <!-- End Code -->
<!-- Modal -->
<?php foreach ($orders as $row): ?>
    <?php 
        $orderId = $row['id'];
        $deliveryDate = $row['preparation_date'];
        $deliveryTime = $row['delivery_time'];
        $deliveryOption = $row['delivery_option'];
        $paymentOption = $row['payment_option'];
        $deliveryAddress = $row['delivery_address'];
        $orderItems = unserialize($row['items']);

        // Calculate subtotal
        $subtotal = 0;
        foreach ($orderItems as $item) {
            $quantity = $item['quantity'];
            $itemPrice = $item['sizePrice'];
            $subtotal += $quantity * $itemPrice;
        }
    ?>
    <div class="modal fade" id="orderModal_<?php echo $orderId; ?>" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Order Details - <?php echo $orderId; ?></h5>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Delivery Date: <?php echo $deliveryDate; ?></p>
                    <p>Delivery Time: <?php echo $deliveryTime; ?></p>
                    <p>Delivery Option: <?php echo $deliveryOption; ?></p>
                    <p>Payment Option: <?php echo $paymentOption; ?></p>
                    <p>Delivery Address: <?php echo $deliveryAddress; ?></p>
                    <hr>
                    <p>Order Items:</p>
                    <ul>
                        <?php foreach ($orderItems as $item): ?>
                            <li><?php echo $item['quantity'] . ' x ' . $item['productName'] . ' - ₱' . ($item['quantity'] * $item['sizePrice']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <p>Total: ₱<?php echo $subtotal; ?></p>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>



    <script>
      function w3_open() {
        document.getElementById("main").style.marginLeft = "25%";
        document.getElementById("mySidebar").style.width = "25%";
        document.getElementById("mySidebar").style.maxWidth = "320px";
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("openNav").style.display = "none";
        document.getElementById("closeNav").style.display = "inline-block";
      }
      function w3_close() {
        document.getElementById("main").style.marginLeft = "0%";
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("openNav").style.display = "inline-block";
        document.getElementById("closeNav").style.display = "none";
      }
      window.addEventListener("load", function () {
        w3_open();
      });
    </script>



<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Get all show-card buttons
    var buttons = document.querySelectorAll('.show-card');
    
    // Add click event listener to each button
    buttons.forEach(function(button) {
      button.addEventListener('click', function() {
        // Hide all card-fields
        var cardFields = document.querySelectorAll('.card-field');
        cardFields.forEach(function(cardField) {
          cardField.style.display = 'none';
        });
        
        // Get the target card id from data-target attribute
        var targetId = button.getAttribute('data-target');
        
        // Show the target card
        var targetCard = document.getElementById(targetId);
        if (targetCard) {
          targetCard.style.display = 'flex';
        }
      });
    });
  });
</script>



<script>
$(document).ready(function () {
    // Check if the URL contains the scrollToCard2 query parameter
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('scrollToCard2')) {
        // Scroll to the card2 element
        const card2Element = document.getElementById('card2');
        if (card2Element) {
            card2Element.scrollIntoView({ behavior: 'smooth' });
        }
    }
});
</script>

  </body>
</html>
