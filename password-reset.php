<?php 
session_start();
include('common/navbar.php');?>

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
    <link
      href="https://fonts.googleapis.com/css2?family=Inika&family=Plus+Jakarta+Sans&display=swap"
      rel="stylesheet"
    />
  </head>



  <div class="container">
      <div class="box form-box"><?php
                    if(isset($_SESSION['status']))
                    {
                        echo"<h4 style='color: red; font-size: 18px;'>" .$_SESSION['status']."<h4>";
                        unset($_SESSION['status']); 
                    }
                    ?>
      <header> Reset Password </header>  
      <form action ="./function/password-reset-code.php" method ="POST">
                                <div class="field input">
                                <label for="Email" style='font-size: 18px;'>Email Address</label> <br>
                                    <input type ="text" name ="email" class = "form-control" placeholder ="Enter Email Address">
                                </div>
                                <div class="field input">
                                <button type ="submit" name ="password_reset_link" class="button">Send Pasword Reset Link</button>
                                </div>
                            </form>
      </div>
</div>


