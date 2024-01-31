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
    <!-- <link rel="stylesheet" type="text/css" href="css/menuelement.css" /> -->
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
  <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
        }

        .menu-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px;
        }

        .menu-item {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 15px;
            padding: 20px;
            text-align: center;
            width: 500px;
            transition: transform 0.3s;
        }

        .menu-item:hover {
            transform: scale(1.05);
        }

        .menu-display {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .food-name {
            font-size: 1.5em;
            margin-bottom: 5px;
        }

        .food-price {
            font-size: 1.2em;
            color: #333;
            margin-bottom: 10px;
        }

        .food-desc {
            color: #555;
            font-size: 1em;
            margin-bottom: 10px;
        }

        .availability {
            color: #777;
            font-size: 0.9em;
            margin-bottom: 10px;
        }

        .category,
        .sub-category {
            color: #777;
            font-size: 0.9em;
        }
    </style>


  <?php include('common/navbar.php');?>

  <?php
$ret = mysqli_query($con, "SELECT p.*, c.categoryName, s.subcategory
                            FROM products p
                            INNER JOIN category c ON p.category = c.id
                            INNER JOIN subcategory s ON p.subCategory = s.id
                            WHERE p.id='$pid'");
while ($row = mysqli_fetch_array($ret)) {
?>
    <div class="menu-container">
    <div class="menu-item">
                <img src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" alt="food" class="menu-display" />
                <div class="detail-field">
                    <p class="food-name"><?php echo htmlentities($row['productName']); ?></a></p>
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
    </div>
<?php } ?>