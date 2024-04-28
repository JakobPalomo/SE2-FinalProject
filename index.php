<?php
session_start();
include('dbcon.php');
?> 

<!-- <php
require __DIR__ . '/function/cancel_static_orders.php';
// Call the cancelPendingOrders function
cancelPendingOrders();

?> -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/navbar.css" />
    <link rel="shortcut icon" type="x-icon" href="./img/logomini.png">
    <link rel="stylesheet" href="css/homepageStyle.css" />
    <script src="https://kit.fontawesome.com/0f6618b60b.js" crossorigin="anonymous"></script>
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
    <div class="topdiv" style="padding-top: 60px;">
      <img src="./img/logo.png" alt="Logo" />
      
    </div>

    <!-- middle part where how to order is located -->
    <div class="orderdiv">
      <br>
    <h1>How to Order</h1>
    <div class="stepdiv">
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
    <a href="subcategory.php?scid=1" class="order-button1">Order Now!</a>
    
    <!-- <div class="bottomdiv">
      <div class="movedown">
      
    </div> 
    </div> -->
    <!-- <div class="foodcontainer"> -->


    <span class="bestseller-txt"><h1>Featured Menu</h1></span>

    <div class="img-container">
    <div class="slide-div" id="slide-1">
        <img src="img/food-1.jpg" alt="" class="img-food" id="img1">
        <div class="overlay">
            <p class="text">Sweet & Sour Pork</p>
        </div>
    </div>
    
    <div class="slide-div" id="slide-2">
        <img src="img/food-2.jpg" alt="" class="img-food" id="img2">
        <div class="overlay">
            <p class="text">Bagnet Kare Kare</p>
        </div>
    </div>
    
    <div class="slide-div" id="slide-3">
        <img src="img/food-3.jpg" alt="" class="img-food" id="img3">
        <div class="overlay">
            <p class="text">Spicy Chicken Wings</p>
        </div>
    </div>
    
    <div class="slide-div" id="slide-4">
        <img src="img/food-4.jpg" alt="" class="img-food" id="img4">
        <div class="overlay">
            <p class="text">Cordon Bleu</p>
        </div>
    </div>
    
    <div class="slide-div" id="slide-5">
        <img src="img/food-5.jpg" alt="" class="img-food" id="img5">
        <div class="overlay">
            <p class="text">Creamy Sipo Eggs</p>
        </div>
    </div>
</div>

</div>
</div>
<?php include('common/footer.php');?>

   <!-- End Code -->
  </body>
</html>