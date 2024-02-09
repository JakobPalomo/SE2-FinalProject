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
    <title>Login</title>
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
    <link
      href="https://fonts.googleapis.com/css2?family=Inika&family=Plus+Jakarta+Sans&display=swap"
      rel="stylesheet"
    />
  </head>
  <body style="background-color: #f5f5dc">
  <?php include('common/navbar.php');?>
     <!-- Code zone -->
  <body>  <!--ito yung sign in to your account  -->
    <div class="container">
      <div class="box form-box">
      <?php
                    if(isset($_SESSION['status']))
                    {
                        echo"<h4>" .$_SESSION['status']."<h4>";
                        unset($_SESSION['status']); 
                    }
                    ?>
        <header>Sign in to your Account</header>
        <form action="./function/login-function.php" method="POST">
          

          <div class="field input">
            <label for="Email">Email</label>
            <input type="text" name="email"  atucomplete="off"  required>
          </div>

          <div class="field input">
            <label for="Email">Password</label>
            <input type="password" name="password"  atucomplete="off" required>
          </div>

          <div class="field">
            <input type="submit"  class="button" name="login_now_btn" value="Login"  required>
            <a href ="password-reset.php" class="float-end">Forgot Password?</a>
          </div>
          <div class="links">
            No Account yet?<a href="register.php"> Sign Up Now</a>
          </div>
          <div class="links">
            Verification Not Sent?<a href="resend-email-verification.php"> Resend</a>
          </div>

         


        </form>
      </div>
    </div>
    <!-- End Code -->
  </body>
</html>
