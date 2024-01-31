<?php
session_start();
include('dbcon.php');
$pid=intval($_GET['pid']);
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

  <?php
$ret = mysqli_query($con, "SELECT * FROM products WHERE id='$pid'");
while ($row = mysqli_fetch_array($ret)) {
?>
    <div class="menu-item">
        <img src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" alt="food" class="menu-display" />
        <div class="detail-field">
            <p class="food-name"><a href="item-detail.php?pid=<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['productName']); ?></a></p>
            <p class="food-price">
                <?php
                echo "M: $" . htmlentities($row['mediumPrice']) . " | ";
                echo "L: $" . htmlentities($row['largePrice']) . " | ";
                echo "XL: $" . htmlentities($row['xlPrice']) . " | ";
                echo "XXL: $" . htmlentities($row['xxlPrice']);
                ?>
            </p>
        </div>
        <div class="desc-field">
            <p class="food-desc"><?php echo htmlentities($row['productDescription']); ?></p>
        </div>
        <div class="availability-field">
            <p class="availability"><?php echo "Availability: " . htmlentities($row['productAvailability']); ?></p>
        </div>
        <div class="category-field">
            <p class="category"><?php echo "Category: " . htmlentities($row['categoryName']); ?></p>
        </div>
        <div class="sub-category-field">
            <p class="sub-category"><?php echo "Subcategory: " . htmlentities($row['subcategory']); ?></p>
        </div>

    </div>
<?php } ?>