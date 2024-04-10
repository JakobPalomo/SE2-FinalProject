<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/navbar.css" />
    <link rel="stylesheet" type="text/css" href="css/register.css" />
    <title>Register</title>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="shortcut icon" type="x-icon" href="./img/logomini.png">

    <link
      href="https://fonts.googleapis.com/css2?family=Inika&family=Plus+Jakarta+Sans&display=swap"
      rel="stylesheet"
    />
  </head>
  <body style="background-color: #f5f5dc">
  <?php include('common/navbar.php');?>
     <!-- Code zone -->
  <body>  <!--ito yung sign up to your account  -->
  
  <br/>
    <div class="container">
      <div class="box form-box">
      <?php
if(isset($_SESSION['status']))
{
    echo '<div class="alert">';
    echo "<h4>" .$_SESSION['status']. "</h4>";
    unset($_SESSION['status']); 
    echo '</div>';
}
?>

        <header>Create your Account</header>
        <form name="registrationForm" action="./function/register-function.php" method="POST" onsubmit="return validateForm()">

        <div class="field input">
                    <label for="FirstName">First Name</label>
                    <input type="text" name="fname" required>
                </div>

                <div class="field input">
                    <label for="LastName">Last Name</label>
                    <input type="text" name="lname" required>
                </div>

                <div class="field input">
                    <label for="Email">Email</label>
                    <input type="text" name="email" required>
                </div>

                <div class="field input">
                    <label for="ContactNumber">Contact Number</label>
                    <input type="text" name="contact" required>
                </div>

                <!-- Separate address inputs -->
                <div class="field input">
                    <label for="BuildingNumber">Building/House Number</label>
                    <input type="text" name="building_number" maxlength="60" required>
                </div>

                <div class="field input">
                    <label for="Street">Street</label>
                    <input type="text" name="street" maxlength="60" required>
                </div>

                <div class="field input">
                    <label for="Barangay">Barangay</label>
                    <input type="text" name="barangay" maxlength="60" required>
                </div>

                <div class="field input">
                    <label for="City">City/Municipality</label>
                    <input type="text" name="city" maxlength="60" required>
                </div>

                <div class="field input">
                    <label for="Province">Province</label>
                    <input type="text" name="province" maxlength="60" required>
                </div>

                <div class="field input">
                    <label for="PostalCode">Postal Code</label>
                    <input type="text" name="postal_code" pattern="\d*" maxlength="60" required>
                </div>

                <div class="field input">
                    <label for="Password">Password</label>
                    <input type="password" name="password" required>
                </div>

                <div class="field input">
                    <label for="ConfirmPassword">Confirm Password</label>
                    <input type="password" name="confirm_password" required>
                </div>

                <input type="checkbox" id="checkbox-1" name="checkbox-1" value="1">
                <label for="checkbox-1">I agree to the terms and conditions.<a class="hyperlink" href=""> Click to View</a></label>

                <div class="field">
                    <input type="submit" class="button" name="register_btn" value="Register" required>
                </div>

                <div class="links">
                    Have an Account?<a class="hyperlink" href="login.php"> Login</a>
                </div>

        </form>
      </div>
    </div>
    <!-- End Code -->
   <!-- Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Add your terms and conditions content here -->
        <!-- Example: -->
        <p>Chef's Daughter Terms and Conditions<br/><br/>

1. Order Confirmation
<br/>
Once orders are confirmed, any changes shall no longer be allowed.
<br/>
2. Food Tray Delivery
<br/>
Once food trays are delivered, it is best advised that food trays must be opened to prevent spoilage.
<br/>
3. Storage of Food Trays
<br/>
Food trays that are not consumed or served an hour after delivery time shall be stored in a cool temperature or area.
<br/>
4. Allergies and Special Requests
<br/>

Inform Chef’s Daughter regarding personal food allergies, if any.
<br/>
Special requests (e.g., chicken part request, no use of MSG, no pepper, etc.) must be discussed upon ordering.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="./js/register.js"></script>
  <script src="./js/termsandcondition.js"></script>
  </body>
  
</html>


