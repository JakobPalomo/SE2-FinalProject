<?php
session_start();
include('dbcon.php');

// Check if the user is authenticated, if not, redirect to the login page
if (!isset($_SESSION['authenticated'])) {
    header("Location: index.php"); // Replace 'login.php' with the actual login page
    exit(); 
}

// Fetch user data from the database
$user_id = $_SESSION['authenticated'];
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
    <link rel="stylesheet" type="text/css" href="css/lectercard.css" />
    <link rel="stylesheet" type="text/css" href="css/pendingordercard.css" />

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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inika&family=Plus+Jakarta+Sans&display=swap"
      rel="stylesheet"
    />
  </head>
  <body style="background-color: #f5f5dc; margin-top:56px;">

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
      <center><button class="add-item mt-5" onclick="redirectToCategory()">ORDER NOW</button></center>
      <a href="#" class="w3-bar-item w3-button show-card" data-target="card1"><span><img src="./img/profile.png" class="icon" />
    </span>My Profile</a>
      <a href="#" class="w3-bar-item w3-button show-card" data-target="card2">
        <span><img src="./img/utensils.png" class="icon" /></span>Pending Order</a>
      <a href="#" class="w3-bar-item w3-button show-card" data-target="card3">
        <span><img src="./img/biking-mountain.png" class="icon"/></span>Accepted Orders</a>
      <a href="#" class="w3-bar-item w3-button show-card" data-target="card4">
        <span><img src="./img/list-check.png" class="icon" /></span>Past Orders</a>
      <a href="./logout.php" class="w3-bar-item w3-button">
        <span><img src="./img/sign-out-alt.png" class="icon" /></span>Logout</a>
    </div>

    <script>
  function redirectToCategory() {
    window.location.href = 'category.php?cid=8';
  }
</script>


    <div class="dashboard" id="main">
      <div class="card-field" id="card1">
        <div class="card-place">
          <div class="card-title"><h1>My Profile</h1></div>
          <!-- Place Content of card here -->
          <div class="inner-card">
            <table>
              <!-- Row 1: Name and Sample Name -->
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

              <!-- Row 2: Address and Sample Address -->
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

              <!-- Row 3: Email and Sample Email -->
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

              <!-- Row 4: Contact number and Sample Contact Number -->
              <tr>
                <td>
                  <div class="column-container">
                    <img
                      src="./img/contactnoicon.png"
                      alt="Contact Number Image"
                    />
                    <div class="info-container">
                      <p class="info-label">Contact number</p>
                      <p class="info"><?php echo $contact; ?></p>
                    </div>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <!-- End of content card -->
        </div>
      </div>

      <?php
        $user_id = $_SESSION['authenticated'];
        $query = "SELECT * FROM pending WHERE user_session_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if(mysqli_num_rows($result) > 0) { 
            // Output the HTML structure for pending orders
            echo "<div class='card-field' id='card2'>
                    <div class='card-place'>
                        <div class='card-title'><h1>Pending Orders</h1></div>
                        <div class='pending-order-container'>";

            // Loop through the fetched data
            while($row = mysqli_fetch_assoc($result)) {
                // Extract data from the current row
                $orderId = $row['id'];
                $orderStatus = $row['status'];
                $orderItems = unserialize($row['items']); // Assuming order_items is a serialized array
                
                // Output order details for each order
                echo "<table class='table-order'>
                        <tr>
                            <td class='orderno'>$orderId</td>
                            <td class='orderstat'>$orderStatus</td>
                        </tr>";

                // Loop through order items for each order
                foreach($orderItems as $item) {
                    $quantity = $item['quantity'];
                    $itemName = $item['productName'];
                    $itemPrice = $item['sizePrice'];
                    // Output order items
                    echo "<tr>
                            <td class='ordername'>$quantity $itemName</td>
                            <td class='orderprice'>$itemPrice</td>
                          </tr>";
                }
                
                echo "</table>";
            }

            // Close the HTML structure for pending orders
            echo "</div>
                </div>
                </div>";
        } else {
            // If no pending orders found
            echo "<p>No pending orders found.</p>";
        }
      ?>


      <div class="card-field" id="card3">
        <div class="card-place">
          <div class="card-title"><h1>Accepted Orders</h1></div>
          <!-- Place Content of card here -->

          <!-- End of content card -->
        </div>
      </div>

      <div class="card-field" id="card4">
        <div class="card-place">
          <div class="card-title"><h1>Past Orders</h1></div>
          <!-- Place Content of card here -->

          <!-- End of content card -->
        </div>
      </div>

        <!-- Add more card-fields with unique ids -->
    </div>

    <!-- End Code -->
    <script>
      function w3_open() {
        document.getElementById("main").style.marginLeft = "25%";
        document.getElementById("mySidebar").style.width = "25%";
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

  </body>
</html>