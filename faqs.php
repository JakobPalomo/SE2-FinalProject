<?php
session_start();
include('./dbcon.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="./css/navbar.css" />
    <link rel="stylesheet" type="text/css" href="./css/faqs.css" />
    <link rel="shortcut icon" type="x-icon" href="./img/logomini.png">
    <title>FAQs</title>
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
  <body style="background-color: #f5f5dc" class="apply-padding">
  <?php include('common/navbar.php');?>

    <script>
      function toggleFaqContent(element) {
        var expandedContent = element.querySelector(".expanded-content");
        var dropIcon = element.querySelector(".drop");

        expandedContent.classList.toggle("show");
        dropIcon.classList.toggle("rotate");
      }
    </script>

    <!-- Code zone -->
    <div class="maintitle">
      <p class="title" style="margin-left: 24px;">Frequently Asked Questions</p>
    </div>

    <div class="centercontainer">
      <div class="itemfaq" onclick="toggleFaqContent(this)">
        <p class="faqcontent">
        Do you offer free delivery?<img
            class="drop"
            src="./img/angle-small-left.png"
          />
        </p>
        <div class="expanded-content">
          <!-- Content to show when the item is expanded -->
          Yes, we provide complimentary delivery service to locations within
           Pampanga up to Balintawak. elivery from Balintawak to your
            specified address can be arranged through Lalamove. 
            Please note that the customer is responsible for 
            covering the Lalamove delivery fee.
        </div>
      </div>

      <div class="itemfaq" onclick="toggleFaqContent(this)">
        <p class="faqcontent">
        How long will my orders take?<img
            class="drop"
            src="./img/angle-small-left.png"
          />
        </p>
        <div class="expanded-content">
          <!-- Content to show when the item is expanded -->
          For orders of 12 trays or more, please place your order
           at least 5 days in advance. For orders of 12 trays or fewer,
            please allow at least 3 days for order placement.
        </div>
      </div>

      <div class="itemfaq" onclick="toggleFaqContent(this)">
        <p class="faqcontent">
        Can I choose my preferred delivery time?<img
            class="drop"
            src="./img/angle-small-left.png"
          />
        </p>
        <div class="expanded-content">
          <!-- Content to show when the item is expanded -->
          Yes, we accommodate delivery times based on the customer's preference.
        </div>
      </div>

      <div class="itemfaq" onclick="toggleFaqContent(this)">
        <p class="faqcontent">
          How can I pay for my order?<img
            class="drop"
            src="./img/angle-small-left.png"
          />
        </p>
        <div class="expanded-content">
          <!-- Content to show when the item is expanded -->
          We accept Cash on Delivery (COD), bank transfers, and Gcash payments.
        </div>
      </div>

      <div class="itemfaq" onclick="toggleFaqContent(this)">
        <p class="faqcontent">
        What are the available tray sizes?<img
            class="drop"
            src="./img/angle-small-left.png"
          />
        </p>
        <div class="expanded-content">
          <!-- Content to show when the item is expanded -->
          We offer trays in sizes: Medium (M), Large (L), Extra Large (XL), and Double Extra Large (XXL).
        </div>
      </div>

      <div class="itemfaq" onclick="toggleFaqContent(this)">
        <p class="faqcontent">
        How can I reach your business for inquiries?<img
            class="drop"
            src="./img/angle-small-left.png"
          />
        </p>
        <div class="expanded-content">
        You can contact us promptly through Facebook Messenger. Our response hours are from 9:00 AM to 9:00 PM.
      </div>
    </div>
    </div>
    
    <footer class="footer">
<br>
      <h3>Contact us through</h3><br>
      <p><i class="fa-brands fa-facebook" style="color: #f5f5f5; font-size:26px;"></i>&nbsp;&nbsp; <a href="https://www.facebook.com/chefsdaughterph" target="_blank"  style="color: inherit; text-decoration: none;">chefsdaughter</a></p>
      <p><i class="fa-solid fa-phone" style="color: #f5f5f5; font-size:26px;"></i>&nbsp;&nbsp; 0915 121 7129</p>
      <p><i class="fa-solid fa-envelope" style="color: #f5f5f5; font-size:26px;"></i>&nbsp;&nbsp; chefsdaughterph@gmail.com</p>
<br>
      <p style="opacity: .6;">2024 Chef's Daughter. All rights reserved.</p>
    </footer>
    <!-- End Code -->
  </body>
</html>
