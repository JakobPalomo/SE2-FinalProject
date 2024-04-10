<?php
session_start();
include('dbcon.php');

// Check if user is logged in
if (!isset($_SESSION['auth_user'])) {
  header("Location: login.php");
  exit();
}

// Check if form is submitted
if (isset($_POST['update_btn'])) {
  $user_id = $_POST['user_id'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $contact = $_POST['contact'];
  $address = $_POST['address'];

  // Update user information in the database
  $query = "UPDATE users SET fname='$fname', lname='$lname', contact='$contact', address='$address' WHERE id=$user_id";
  if (mysqli_query($con, $query)) {
    $_SESSION['status'] = "Account updated successfully!";
  } else {
    $_SESSION['status'] = "Error updating account: " . mysqli_error($con);
  }

  // Redirect back to the edit account page
  header("Location: user-account.php");
  exit();
}

// Retrieve user's information from the database
$user_id = $_SESSION['auth_user']['id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="css/navbar.css" />
  <link rel="stylesheet" type="text/css" href="css/menuelement.css" />
  <link rel="stylesheet" type="text/css" href="css/register.css" />
  <title>Edit Account</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="shortcut icon" type="x-icon" href="./img/logomini.png">
</head>
<body style="background-color: #f5f5dc">
  <?php include('common/navbar.php'); ?>

  <!-- Code zone -->
  <br />
  <div class="container">
    <div class="box form-box">
      

      <header>Edit your Account</header>
      <form name="registrationForm" action="editaccount.php" method="POST" onsubmit="return confirmUpdate()">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <div class="field input">
          <label for="FirstName">First Name</label>
          <input type="text" name="fname" value="<?php echo $row['fname']; ?>" required>
        </div>

        <div class="field input">
          <label for="LastName">Last Name</label>
          <input type="text" name="lname" value="<?php echo $row['lname']; ?>" required>
        </div>

        <div class="field input">
          <label for="ContactNumber">Contact Number</label>
          <input type="text" name="contact" value="<?php echo $row['contact']; ?>" required>
        </div>

        <div class="field input">
          <label for="Address">Address</label>
          <input type="text" name="address" value="<?php echo $row['address']; ?>" required>
        </div>

        <div class="field">
          <input type="submit" class="button" name="update_btn" value="Update" required>
        </div>

      </form>
    </div>
  </div>
  <!-- End Code -->
  <script>
    function confirmUpdate() {
      return confirm("Are you sure you want to update your account?");
    }
  </script>
</body>
</html>
