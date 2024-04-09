<?php
session_start();
include('dbcon.php');
?> 
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
    <div class="topdiv">
      <img src="./img/logo.png" alt="Logo" />
      
    </div>

    <!-- middle part where how to order is located -->
    <div class="orderdiv">
    <a href="category.php?cid=8" class="order-button1"><i class="fa-solid fa-utensils" style="color: #004225;"></i> Order Now</a>
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

    <!-- last part of the homepage -->
    
    <div class="bottomdiv">
      <div class="movedown">
      <div class="textandpiccontainer">
        <p>
      We are an online food business and we offer
      𝐅𝐑𝐄𝐄 𝐃𝐄𝐋𝐈𝐕𝐄𝐑𝐘 𝐚𝐧𝐲𝐰𝐡𝐞𝐫𝐞 𝐢𝐧 𝐏𝐀𝐌𝐏𝐀𝐍𝐆𝐀. We accept 𝐀𝐃𝐕𝐀𝐍𝐂𝐄, 𝐒𝐇𝐎𝐑𝐓 𝐀𝐍𝐃 𝐁𝐔𝐋𝐊 𝐎𝐑𝐃𝐄𝐑𝐒 that fits on every occasion you celebrate. 
      Message us and we will be sending you shortly our 𝐅𝐔𝐋𝐋 𝐌𝐄𝐍𝐔 𝐀𝐍𝐃 𝐏𝐑𝐈𝐂𝐄𝐋𝐈𝐒𝐓 for your reference.
       We are glad to assist you and we look forward in serving you soon! Thank you very much! 

        </p>
        <img src="./img/pic1.jpg" alt="Pic1" />
      </div>

      <div class="textandpiccontainer">
        <img src="./img/pic2.jpg" alt="Pic2" />
        <p>
        Chef's Daughter was born to honor, remember and continue a family's passion in cooking even though 
        they are now worlds apart. This is my wife’s small food business and since her dad, mom & kuya passed away,
         cooking has become her therapy and it gives her the comfort and connection with her departed loved ones. 
         The food offered (chef’s daughter spicy pork & chicken) is a home specialty of the Dantes’ and it is served every 
         special family occasion. Now that she’s longing to feel the same vibe as before when her family is complete, Chef’s Daughter 
         thought that its time for other families & people to taste this special food. Giving her full focus & effort every time she prepares and
          cooks, I am assuring all of you that this food will satisfy, if not, will exceed your expectations. Because in Chef’s Daughter, the secret ingredient is always love. 🦋🦋🦋
        </p>
      </div>
    </div>
      
    </div>

    <!-- End Code -->
  </body>
</html>