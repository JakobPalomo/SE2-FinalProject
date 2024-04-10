<?php
session_start();
include('dbcon.php');

// Check if user is logged in
if (!isset($_SESSION['auth_user'])) {
  header("Location: login.php");
  exit();
}

// Function to check password strength
function is_strong_password($password) {
    // Add your password strength criteria here
    $length = strlen($password) >= 8;
    $uppercase = preg_match('/[A-Z]/', $password);
    $lowercase = preg_match('/[a-z]/', $password);
    $digit = preg_match('/\d/', $password);

    return $length && $uppercase && $lowercase && $digit;
}

// Check if form is submitted
if (isset($_POST['change_btn'])) {
  $user_id = $_POST['user_id'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  if ($new_password !== $confirm_password) {
    echo '<script>alert("Passwords do not match.");</script>';
  } elseif (!is_strong_password($new_password)) {
    echo '<script>alert("Password should be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one digit.");</script>';
  } else {
    // Update user's password in the database
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $query = "UPDATE users SET password='$hashed_password' WHERE id=$user_id";
    if (mysqli_query($con, $query)) {
      echo '<script>alert("Password changed successfully!");</script>';
    } else {
      echo '<script>alert("Error changing password: ' . mysqli_error($con) . '");</script>';
    }
  }
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
  <title>Change Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="shortcut icon" type="x-icon" href="./img/logomini.png">
</head>
<body style="background-color: #f5f5dc">
  <?php include('common/navbar.php'); ?>

  <!-- Code zone -->
  <br />
  <div class="container">
    <div class="box form-box">

      <header>Change Password</header>
      <form name="passwordForm" action="changepassword.php" method="POST" onsubmit="return validatePasswords()">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <div class="field input">
          <label for="NewPassword">New Password</label>
          <input type="password" name="new_password" required>
        </div>

        <div class="field input">
          <label for="ConfirmPassword">Confirm Password</label>
          <input type="password" name="confirm_password" required>
        </div>

        <div class="field">
          <input type="submit" class="button" name="change_btn" value="Change Password" required>
        </div>

      </form>
    </div>
  </div>
  <!-- End Code -->
  <script>
    function validatePasswords() {
      var newPassword = document.forms["passwordForm"]["new_password"].value;
      var confirmPassword = document.forms["passwordForm"]["confirm_password"].value;

      if (newPassword !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
      }

      return true;
    }
  </script>
</body>
</html>
