<?php 
session_start();

include('common/navbar.php');?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/navbar.css" />
    <link rel="shortcut icon" type="x-icon" href="./img/logomini.png">
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

  <?php
                    if(isset($_SESSION['status']))
                    {
                        echo"<h4>" .$_SESSION['status']."<h4>";
                        unset($_SESSION['status']); 
                    }
                    ?>


  <div class="container">
      <div class="box form-box">
      <header> Input New Password </header>
      <form action ="./function/password-reset-code.php" method ="POST" onsubmit="return validatePassword()">
                                <input type = "hidden" name ="password_token" value ="<?php if(isset($_GET['token'])){echo $_GET['token'];}?>">
                                <div class="field input">
                                    <label>Email Address</label>
                                    <input type ="text" name ="email" class = "form-control" value ="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" placeholder ="Enter Email Address">
                                </div>
                                <div class="field input">
                                    <label>New Password</label>
                                    <input type ="password" name ="new_password" class = "form-control" placeholder ="Enter New Password">
                                </div>
                                <div class="field input">
                                    <label>Confirm Password</label>
                                    <input type ="password" name ="confirm_password" class = "form-control" placeholder ="Confirm New Password">
                                </div>
                                <div class="field input">
                                <button type ="submit" name ="password_update" class = "button">Submit</button>
                                </div>
                            </form>
      </div>
  </div>



<script>
    function validatePassword() {
        var password = document.getElementById('new_password').value;
        var confirmPassword = document.getElementById('confirm_password').value;

        var passwordStrengthRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/;

        if (!passwordStrengthRegex.test(password)) {
            alert("Password should contain at least 8 characters, including one uppercase letter, one lowercase letter, and one digit.");
            return false;
        }

        if (password !== confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }

        return true;
    }
</script>


