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
  <body style="background-color: #f5f5dc">
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
          How can I pay for my order?<img
            class="drop"
            src="./img/angle-small-left.png"
          />
        </p>
        <div class="expanded-content">
          <!-- Content to show when the item is expanded -->
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. ...
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
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. ...
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
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. ...
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
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. ...
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
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. ...
        </div>
      </div>
    </div>

    <!-- End Code -->
  </body>
</html>
