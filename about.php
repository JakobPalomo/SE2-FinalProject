<?php
session_start();
include('dbcon.php');
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="./css/navbar.css" />
    <link rel="shortcut icon" type="x-icon" href="./img/logomini.png">
    <link rel="stylesheet" href="./css/aboutus.css" />
    <title>About Us</title>
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
    <script src="https://kit.fontawesome.com/0f6618b60b.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inika&family=Plus+Jakarta+Sans&display=swap"
      rel="stylesheet"
    />
  </head>
  <body style="background-color: #f5f5dc;" class="apply-padding">

  <?php include('common/navbar.php');?>
    <!-- Code of About -->

    <!-- top part of the About after the navbar -->
    <div class="topdiv">
        <a class="about">About Us</a>
    </div>

    <!-- last part of the homepage -->
    <div class="bottomdiv">
      <div class="textandpiccontainer">
        <p>
            Chef's Daughter was born to honor, remember and continue a family's passion in cooking even though 
            they are now worlds apart. This is my wife’s small food business and since her dad, mom & kuya passed away,
             cooking has become her therapy and it gives her the comfort and connection with her departed loved ones. 
             The food offered (chef’s daughter spicy pork & chicken) is a home specialty of the Dantes’ and it is served every 
             special family occasion. Now that she’s longing to feel the same vibe as before when her family is complete, Chef’s Daughter 
             thought that its time for other families & people to taste this special food. Giving her full focus & effort every time she prepares and
              cooks, I am assuring all of you that this food will satisfy, if not, will exceed your expectations. Because in Chef’s Daughter, the secret ingredient is always love. 🦋🦋🦋
        </p>
        <img src="./img/cateringbg.jpg" alt="Pic1" />
      </div>

      <div class="textandpiccontainer">
        <img src="./img/pic2.jpg" alt="Pic2" />
        <p>
            We are an online food business and we offer
            𝐅𝐑𝐄𝐄 𝐃𝐄𝐋𝐈𝐕𝐄𝐑𝐘 𝐚𝐧𝐲𝐰𝐡𝐞𝐫𝐞 𝐢𝐧 𝐏𝐀𝐌𝐏𝐀𝐍𝐆𝐀. We accept 𝐀𝐃𝐕𝐀𝐍𝐂𝐄, 𝐒𝐇𝐎𝐑𝐓 𝐀𝐍𝐃 𝐁𝐔𝐋𝐊 𝐎𝐑𝐃𝐄𝐑𝐒 that fits on every occasion you celebrate. 
            Message us and we will be sending you shortly our 𝐅𝐔𝐋𝐋 𝐌𝐄𝐍𝐔 𝐀𝐍𝐃 𝐏𝐑𝐈𝐂𝐄𝐋𝐈𝐒𝐓 for your reference.
             We are glad to assist you and we look forward in serving you soon! Thank you very much! 
      </div>
    </div>
    </div>
    <?php include('common/footer.php');?>
    <!--End Code-->
  </body>
</html>
