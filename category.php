<?php
include('dbcon.php');
$cid=intval($_GET['cid']);
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/navbar.css" />
    <link rel="stylesheet" href="css/menupageStyle.css" />
    <link rel="stylesheet" type="text/css" href="css/menuelement.css" />
    <title>Menu</title>
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
    <!-- Code zone -->
    <!-- top part of the menupage after the navbar -->
    <div class="topdiv">
      <img src="img/logo.png" alt="Logo" />
      <div class="search-container">
        <input type="text" class="search-input" placeholder="Search..." />
        <div class="search-icon">&#128269;</div>
      </div>
    </div>

    <!-- div for the category buttons-->
    <div class="categorydiv">    
        <?php
        $sql = mysqli_query($con, "SELECT id, categoryName FROM category LIMIT 6");
        while ($row = mysqli_fetch_array($sql)) {
        ?>
            <a href="category.php?cid=<?php echo $row['id']; ?>" class="categorybutton">
                <?php echo $row['categoryName']; ?>
            </a>
        <?php
        }
        ?>
      </div>

    <div class="list">

          <?php
          $ret = mysqli_query($con, "select * from products where category='$cid'");
          $num = mysqli_num_rows($ret);

          if ($num > 0) {
              while ($row = mysqli_fetch_array($ret)) {
          ?>
                  <div class="menu-item">
                      <img src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" alt="food" class="menu-display" />
                      <div class="detail-field">
                          <p class="food-name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['productName']); ?></a></p>
                          <p class="food-price">View Prices</p>
                          
                      </div>
                      <div class="desc-field">
                          <p class="food-desc"><?php echo htmlentities($row['productDescription']); ?></p>
                      </div>
                      <center><button class="add-item">Add to Cart</button></center>
                  </div>
          <?php
                    }
                } else {
                ?>
                   
                 <p class="food-name">No Products Found</p>
            
                <?php
                }
                ?>
    </div>

    <!--Menu item-->

    <!-- End Code -->
  </body>
</html>
