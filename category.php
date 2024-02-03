<?php
session_start();
include('dbcon.php');
$cid=intval($_GET['cid']);
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
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

  <style>
    .menu-item {
            transition: transform 0.3s;
        }

        .menu-item:hover {
            transform: scale(1.05);
        }

  </style>


<script>
function addToCart(productId, productName, mediumPrice, largePrice, xlPrice, xxlPrice) {
    var size = document.getElementById("size" + productId).value;
    var quantity = document.getElementById("quantity" + productId).value;
    

    // Calculate total price based on size and quantity
    var price = 0;

    switch (size) {
        case 'M':
            price = mediumPrice;
            break;
        case 'L':
            price = largePrice;
            break;
        case 'XL':
            price = xlPrice;
            break;
        case 'XXL':
            price = xxlPrice;
            break;
        default:
            price = 0;
            break;
    }

    var IndivPrice = price * quantity;

    var item = {
        productId: productId,
        productName: productName,
        size: size,
        quantity: quantity,
        totalIndivudalPrice: IndivPrice
    };
    console.log("Item added to cart:", item);

    var itemJSON = JSON.stringify(item);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./function/addToCart.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert("Item added to the cart!");
            // Use Bootstrap modal method to hide the modal
            $('#addToCartModal' + productId).modal('hide');
            // Reset any modal state here if necessary
        }
    };
    xhr.send("item=" + encodeURIComponent(itemJSON));
}
</script>


  <?php include('common/navbar.php');?>



    <!-- Code zone -->
    <!-- top part of the menupage after the navbar -->
    <div class="topdiv">
      <img src="img/logo.png" alt="Logo" />
      <div class="search-container">
        <input type="text" class="search-input" placeholder="Search..." id="searchInput" oninput="filterProducts()"/>
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
                $productId = $row['id'];
          ?>
                  <div class="menu-item">
                      <img src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" alt="food" class="menu-display" />
                      <div class="detail-field">
                          <p class="food-name"><a href="item-detail.php?pid=<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['productName']); ?></a></p>
                          <p class="food-price">M | L | XL | XXL</p>
                          
                      </div>
                      <div class="desc-field">
                          <p class="food-desc"><?php echo htmlentities($row['productDescription']); ?></p>
                      </div>
                      <center>
                    <button class="add-item" data-bs-toggle="modal" data-bs-target="#addToCartModal<?php echo $row['id']; ?>">Add to Cart</button>
                </center>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addToCartModal<?php echo $productId; ?>" tabindex="-1" aria-labelledby="addToCartModalLabel<?php echo $productId; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addToCartModalLabel<?php echo $productId; ?>">Add to Cart</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addToCartForm<?php echo $productId; ?>">
                                <h6 class="ms-auto"><?php echo htmlentities($row['productName']); ?></h6> <br>
                                <label for="quantity">Quantity:</label>
                                <input type="number" id="quantity<?php echo $productId; ?>" name="quantity" value="1" min="1" onchange="updatePriceAndTotal(<?php echo $productId; ?>, <?php echo htmlentities($row['mediumPrice']); ?>, <?php echo htmlentities($row['largePrice']); ?>, <?php echo htmlentities($row['xlPrice']); ?>, <?php echo htmlentities($row['xxlPrice']); ?>)">

                                <label for="size">Size:</label>
                                <select id="size<?php echo $productId; ?>" name="size" onchange="updatePriceAndTotal(<?php echo $productId; ?>, <?php echo htmlentities($row['mediumPrice']); ?>, <?php echo htmlentities($row['largePrice']); ?>, <?php echo htmlentities($row['xlPrice']); ?>, <?php echo htmlentities($row['xxlPrice']); ?>)">
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>

                                <p id="priceDisplay<?php echo $productId; ?>">Price: $<?php echo htmlentities($row['mediumPrice']); ?></p>

                                <p id="totalPriceDisplay<?php echo $productId; ?>">Total Price: $<?php echo htmlentities($row['mediumPrice']); ?></p>

                                <input type="hidden" id="productId<?php echo $productId; ?>" name="productId" value="<?php echo $productId; ?>">
                            </form>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="addToCart(<?php echo $row['id']; ?>, '<?php echo htmlentities($row['productName']); ?>', <?php echo htmlentities($row['mediumPrice']); ?>)">Add to Cart</button>
                        </div>
                    </div>
                </div>
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

    <script>
    function updatePriceAndTotal(productId, mediumPrice, largePrice, xlPrice, xxlPrice) {
        var size = document.getElementById("size" + productId).value;
        var quantity = document.getElementById("quantity" + productId).value;
        var price = 0;

        switch (size) {
            case 'M':
                price = mediumPrice;
                break;
            case 'L':
                price = largePrice;
                break;
            case 'XL':
                price = xlPrice;
                break;
            case 'XXL':
                price = xxlPrice;
                break;
            default:
                price = 0;
                break;
        }

        var totalPrice = price * quantity;

        document.getElementById("priceDisplay" + productId).innerText = "Price: $" + price;
        document.getElementById("totalPriceDisplay" + productId).innerText = "Total Price: $" + totalPrice;
    }

     function preventFormSubmission(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            // Optionally, you can trigger the updatePriceAndTotal function here as well
            // updatePriceAndTotal(productId, mediumPrice, largePrice, xlPrice, xxlPrice);
        }
    }

    // Attach the function to the form's keydown event
    document.addEventListener('keydown', function (event) {
        preventFormSubmission(event);
    });



    function filterProducts() {
        var input, filter, menuItems, item, productName;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        menuItems = document.getElementsByClassName("menu-item");

        for (var i = 0; i < menuItems.length; i++) {
            item = menuItems[i];
            productName = item.querySelector(".food-name a").innerText.toUpperCase();
            if (productName.indexOf(filter) > -1) {
                item.style.display = "";
            } else {
                item.style.display = "none";
            }
        }
    }
</script>






    <!--Menu item-->

    <!-- End Code -->
  </body>
</html>