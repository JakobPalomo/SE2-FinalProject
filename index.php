<?php 
include('./function/authentication.php')
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/navbar.css" />
    <link rel="stylesheet" href="css/homepageStyle.css" />
    <title>Home</title>
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
  <?php include('common/navbar.php');?>

   <!-- Code of homepage -->

    <!-- top part of the homepage after the navbar -->
    <div class="topdiv">
      <img src="./img/logo.png" alt="Logo" />
      <a href="#" class="order-button">Order Now</a>
    </div>

    <!-- middle part where how to order is located -->
    <div class="orderdiv">
      <h1>How to Order</h1>
      <div class="stepdiv">
        <div class="elementcontainer">
          <a href="#" class="circularnumber">1</a>
          <h5>Login/Create Account</h5>
        </div>
        <div class="elementcontainer">
          <img src="./img/user.png" alt="User" />
        </div>
      </div>
      <div class="stepdiv">
        <div class="elementcontainer">
          <a href="#" class="circularnumber">2</a>
          <h5>Select Items from Menu</h5>
        </div>
        <div class="elementcontainer">
          <img src="./img/menu.png" alt="Menu" />
        </div>
      </div>
      <div class="stepdiv">
        <div class="elementcontainer">
          <a href="#" class="circularnumber">3</a>
          <h5>Checkout & Pay</h5>
        </div>
        <div class="elementcontainer">
          <img src="./img/pay.png" alt="Pay" />
        </div>
      </div>
    </div>

    <!-- last part of the homepage -->
    <div class="bottomdiv">
      <div class="textandpiccontainer">
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
          hendrerit libero odio, eget volutpat neque dapibus in. Suspendisse
          mattis nec eros et sollicitudin. Vivamus ornare, justo in venenatis
          accumsan, velit nibh viverra urna,
        </p>
        <img src="./img/pic1.jpg" alt="Pic1" />
      </div>

      <div class="textandpiccontainer">
        <img src="./img/pic2.jpg" alt="Pic2" />
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
          hendrerit libero odio, eget volutpat neque dapibus in. Suspendisse
          mattis nec eros et sollicitudin. Vivamus ornare, justo in venenatis
          accumsan, velit nibh viverra urna,
        </p>
      </div>
    </div>

    <!-- End Code -->
  </body>
</html>