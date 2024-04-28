<?php
include('dbcon.php');
$includeFixedTop = true;
$fixedTop = isset($includeFixedTop) && $includeFixedTop ? 'fixed-top' : '';
?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="x-icon" href="./img/logomini.png">
  <link rel="stylesheet" type="text/css" href="./css/navbar.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src="https://kit.fontawesome.com/0f6618b60b.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inika&family=Plus+Jakarta+Sans&display=swap" rel="stylesheet">
  <style>
    .navbar-nav2 {
      margin-right: auto; /* Push the menu items to the left */
      margin-left: 20px;
    }

    .navbar-nav .nav-item {
      margin-right: 5px; /* Add space between menu items */
    }
    .navbar-nav3 {
      margin-right: 25px; /* Add space between menu items */
    }
  </style>
</head>
<body style="background-color: #f5f5dc">
  <nav class="navbar navbar-expand-lg <?php echo $fixedTop; ?>">
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
        <ul class="navbar-nav navbar-nav2">
          <li class="nav-item">
            <a class="navbutton" href="subcategory.php?scid=1">Menu</a>
          </li>
          <li class="nav-item">
            <a class="navbutton" href="./faqs.php">FAQs</a>
          </li>
          <li class="nav-item">
            <a class="navbutton" href="./about.php">About Us</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto navbar-nav3">
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
              <a class="navbutton" href="./cart.php">
                <i class="fa-solid fa-cart-shopping" style="color: #ffffff; position: relative;">
                  <?php echo isset($_SESSION['cart']) && count($_SESSION['cart']) > 0 ? '<span class="badge rounded-pill badge-notification bg-danger position-absolute top-0 start-100 translate-middle" style="font-size: 0.6em;">' . count($_SESSION['cart']) . '</span>' : ''; ?>
                </i>
              </a>
            </li>
          <?php endif?>
        </ul>
      </div>
    </div>
  </nav>
</body>
</html>




<!--  if(isset($_SESSION['authenticated'])) :?>
            <li class="nav-item">
            <a class="navbutton" aria-current="page" href="./logout.php">Logout</a>
            </li>
             endif?> -->