<?php
include('dbcon.php');
$fixedTop = isset($includeFixedTop) && $includeFixedTop ? 'fixed-top' : '';
?> 

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="./css/navbar.css" />
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
    <nav class="navbar navbar-expand-lg <?php echo $fixedTop; ?>">
    <?php if(isset($includeButton) && $includeButton): ?>
      <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">
        <div class="arrow">></div>
      </button>
      <button id="closeNav" class="w3-button w3-xlarge" onclick="w3_close()">
        <div class="arrow">&#60;</div>
      </button>
    <?php endif; ?>
      <div class="container-fluid">
        <a class="brand" href="index.php">Chef's Daughter</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="navbutton" href="category.php?cid=8">Menu</a>
            </li>
            <li class="nav-item">
              <a class="navbutton" href="./faqs.php">FAQs</a>
            </li>
            <?php if(!isset($_SESSION['authenticated'])) :?>
            <li class="nav-item">
              <a class="navbutton" aria-current="page" href="./login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="navbutton" aria-current="page" href="./register.php">Register</a>
            </li>
            <?php endif?>
            <?php if(isset($_SESSION['authenticated'])) :?>
            <li class="nav-item">
              <a class="navbutton" href="./user-account.php">My Account</a>
            </li>
            <?php endif?>
            <?php if(isset($_SESSION['authenticated'])) :?>
            <li class="nav-item">
              <a class="navbutton" href="./cart.php">My Cart</a>
            </li>
            <?php endif?>
            <?php if(isset($_SESSION['authenticated'])) :?>
            <li class="nav-item">
              <a class="navbutton" aria-current="page" href="./logout.php">Logout</a>
            </li>
            <?php endif?>
          </ul>
        </div>
      </div>
    </nav>
  </body>
</html>
