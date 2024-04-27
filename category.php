<?php
session_start();
include('dbcon.php');
$cid=intval($_GET['cid']);
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if(isset($_POST['add_to_cart'])) {
    // Check if the user is authenticated
    if(!isset($_SESSION['authenticated'])) {
        $_SESSION['status'] = "Please Login to Add Items to Cart";
        header('Location: authentication.php');
        exit(0);
    }

}
?> 



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/navbar.css" />
    <link rel="shortcut icon" type="x-icon" href="./img/logomini.png">
    <link rel="stylesheet" href="css/menupageStyle.css" />
    <link rel="stylesheet" type="text/css" href="./css/faqs.css" />
    <link rel="stylesheet" type="text/css" href="css/menuelement.css" />
    <link rel="stylesheet" type="text/css" href="./css/ordermodal.css" />
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
    <script src="https://kit.fontawesome.com/0f6618b60b.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inika&family=Plus+Jakarta+Sans&display=swap"
      rel="stylesheet"
    />
    <script src="https://kit.fontawesome.com/0f6618b60b.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  </head>

 <!-- inline style-->
  <body style="background-color: #f5f5dc" class="apply-padding">
  <style>
    .menu-item {
            transition: transform 0.3s;
        }

        .menu-item:hover {
            transform: scale(1.05);
        }
  </style>




  <?php include('common/navbar.php');?>



    <!-- Code zone -->
    <!-- top part of the menupage after the navbar -->
    <div class="topdiv" style=" background-image: none;  margin:20px; height: 350px;">
      <img src="img/logo.png" alt="Logo" style="max-width: 200px;"/>
      <div class="maintitle">
      <p class="title" style="margin-top: -28px;">Menu</p>
    </div>
      <div class="search-container">
        <input type="text" class="search-input" placeholder="Search..." id="searchInput" oninput="filterProducts()"/>
        <div class="search-icon"><i class="fa-solid fa-magnifying-glass" style="color: #262626;"></i></div>
      </div>
    </div>


<!--to make the side bar -->
      <div class="side-by-side">  
            <!-- div for subcat buttons-->
            <!-- <div class="subcategorydiv">
    <div class="food-name subcat" style="margin-bottom: 12px; font-size: 10px; padding-left: 12px;">Sub Categories</div>
    <div class="subcatbutton">
        <?php 
        $sql = mysqli_query($con, "SELECT id, subcategory FROM subcategory WHERE categoryid='$cid'");
        while ($row = mysqli_fetch_array($sql)) {
            $subcategory = $row['subcategory'];
            $iconClass = '';

            // Set the icon class based on the subcategory
            if (strtolower($subcategory) == 'pasta') {
                $iconClass = 'fa-plate-wheat'; // Pasta icon
            } elseif (strpos(strtolower($subcategory), 'chicken') !== false) {
                $iconClass = 'fa-drumstick-bite'; // Chicken icon
            }else {
                $iconClass = 'fa-utensils'; // Default utensils icon
            }
            
        ?>
        <a href="subcategory.php?scid=<?php echo $row['id'];?>" class="categorybutton1" style="font-weight: bolder;">
            <span><i class="fa-solid" style="color: #262626;"></i> </span><?php echo $subcategory;?> 
        </a>
        <?php } ?>
    </div>
</div> -->


       <div class="main-menu">
    <!-- div for the category buttons-->
    <div class="options">
<div class="category-container">
    <div class="categorydiv"> <p><i class="fa-solid fa-utensils" style="color: #262626;"></i> Main Categories: </p>
        
    <?php
    $sql = mysqli_query($con, "SELECT id, categoryName FROM category LIMIT 6");
    while ($row = mysqli_fetch_array($sql)) {
        $categoryId = $row['id'];
        $categoryName = $row['categoryName'];
        $iconClass = '';

        // Set the icon class based on the category name
        if (strtolower($categoryName) == 'short order') {
            $iconClass = 'fa-bowl-food'; // Bowl food icon
        }elseif (strtolower($categoryName) == 'bulk order') {
            $iconClass = 'fa-truck-moving'; // Bowl food icon
        }
    ?>
        <a href="category.php?cid=<?php echo $categoryId; ?>" class="categorybutton">
            <?php if (!empty($iconClass)) { ?>
                <i class="fa-solid <?php echo $iconClass; ?>" style="color: #262626;"></i>
            <?php } ?> 
            <?php echo $categoryName; ?>
        </a>
    <?php
    }
    ?>
</div>
    </div>
    <div class="category-container">
    <div class="categorydiv"> <p><i class="fa-solid fa-drumstick-bite" style="color: #262626;"></i> Sub Categories: </p>
        
    <?php 
        $sql = mysqli_query($con, "SELECT id, subcategory FROM subcategory WHERE categoryid='$cid'");
        while ($row = mysqli_fetch_array($sql)) {
            $subcategory = $row['subcategory'];
            $iconClass = '';

            // Set the icon class based on the subcategory
            if (strtolower($subcategory) == 'pasta') {
                $iconClass = 'fa-plate-wheat'; // Pasta icon
            } elseif (strpos(strtolower($subcategory), 'chicken') !== false) {
                $iconClass = 'fa-drumstick-bite'; // Chicken icon
            }else {
                $iconClass = 'fa-utensils'; // Default utensils icon
            }
            
        ?>
        <a href="subcategory.php?scid=<?php echo $row['id'];?>" class="categorybutton1" style="font-weight: bolder;">
            <span><i class="fa-solid" style="color: #262626;"></i> </span><?php echo $subcategory;?> 
        </a>
        <?php } ?>
</div>
    </div>

    </div>
    


        <div class="list">
          <?php
          $ret = mysqli_query($con, "select * from products where category='$cid'");
          $num = mysqli_num_rows($ret);

          if ($num > 0) {
              while ($row = mysqli_fetch_array($ret)) {
                $productId = $row['id'];
                $availability = $row['productAvailability'];
                if ($availability == 'Remove') {
                    continue;
                }
                
                $menuClass = ($availability == 'Out of Stock') ? 'menu-item-unavailable' : ''; // Add class if product is out of stock
          ?>
               
                  <div class="menu-item <?php echo $menuClass; ?>">
                  <div class="img-container-menu">
                      <img src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" alt="food" class="menu-display" />
                      </div>
                      <div class="detail-field">
                          <p class="food-name"><?php echo htmlentities($row['productName']); ?></p>  
                      </div>
                      <div class="desc-field"> 
                                <?php if ($availability != 'Out of Stock'): ?>
                             <p class="food-desc">
                                M- ₱<strong><?php echo number_format($row['mediumPrice'], 2, '.', ','); ?></strong></br>
                                L- ₱<strong><?php echo number_format($row['largePrice'], 2, '.', ','); ?></strong></br>
                                XL- ₱<strong><?php echo number_format($row['xlPrice'], 2, '.', ','); ?></strong></br>
                                XXL- ₱<strong><?php echo number_format($row['xxlPrice'], 2, '.', ','); ?></strong>
                            </p>
                         
                                 <?php endif; ?>
                      </div>
                        <center>
                            <?php if($availability != 'Out of Stock'): ?>
                            <button class="add-item" data-bs-toggle="modal" data-bs-target="#addToCartModal<?php echo $row['id']; ?>" onclick="addToCartAndReset(<?php echo $row['id']; ?>)">Add to Cart</button>
                            <?php else: ?>
                            <button class="add-item disabled" disabled>Not Available</button>
                            <?php endif; ?>
                        </center>
                    </div>

                  

            <!-- Modal -->
    <div class="modal fade" id="addToCartModal<?php echo $productId; ?>" tabindex="-1" aria-labelledby="addToCartModalLabel<?php echo $productId; ?>" aria-hidden="true" data-bs-backdrop="false">
     <div class="wrapper">
        <div class="modal-dialog">
   
        <div class="modal-content" style="background-color: transparent; border: none">
                <div class="order-list" >
                    <div class="order-item">
                        <div class="img-container-modal">
                        <img src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" alt="food" class="item-display" />
                </div>
                        <div class="details">
                            <form>
                                
                                <div class="labels"></div>
                                <div style="display: flex">
                                    <p class="food-namemod"><?php echo htmlentities($row['productName']); ?></p>
                                    <p class="food-price">₱ <span id="totalPrice<?php echo $productId; ?>"><?php echo number_format($row['mediumPrice'], 2, '.', ','); ?></span></p>
                                </div>

                                <div class="labels"></div>
                                <p class="description"><?php echo htmlentities($row['productDescription']); ?></p>
                                <div class="buttons">
                                    <br />
                                    <img src="./img/minus-circle.png" alt="Decrease" class="btn" onclick="decrease('<?php echo $productId; ?>')" />
                                    <input type="text" id="numberField<?php echo $productId; ?>" value="1" readonly style="width: 50px; text-align: center; border-radius: 14px" />
                                    <img src="./img/add.png" alt="Increase" class="btn" onclick="increase('<?php echo $productId; ?>')" />
                                </div>
                                <br />

                                <div class="buttons">
                                    <div class="button-group">
                                    <?php
                                        $sizes = array("medium", "large", "xl", "xxl"); // Add your sizes here
                                        foreach ($sizes as $size) {
                                            $price = $row[$size . 'Price'];
                                            $checkboxId = $productId . '_' . $size; // Unique ID for each checkbox
                                                echo '<label class="check-button" id="' . $checkboxId . '" onclick="toggleCheck(\'' . $checkboxId . '\', ' . htmlentities($price) . ')">';
                                                echo '<input type="radio" name="size' . $productId . '" data-price="' . htmlentities($price) . '" />';
                                                echo ucfirst($size) . ' - ₱ ' . number_format($price, 2);
                                                echo '</label>'; } ?>
                                    </div>
                                </div>

                                <div class="buttons">
                                    <input type="button" value="Close" class="add-itemmod" data-bs-dismiss="modal" onclick="resetModal('<?php echo $productId; ?>')" />
                                    <input type="button" value="Confirm" class="add-itemmod" onclick="addToCart('<?php echo $productId; ?>')" />
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
 
        </div>
     </div>
    </div>

    <!-- Item Added Modal -->
    <div class="modal fade" id="itemAddedModal" tabindex="-1" aria-labelledby="itemAddedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itemAddedModalLabel">Item Added to Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Your item has been successfully added to the cart <i class="fa-solid fa-cart-shopping" style="color: #000000; position: relative;"></i>
            </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                An error occurred while adding the item to the cart. Please try again later.
            </div>
            </div>
        </div>
    </div>


    <script>

    function addToCartAuthenticate(productId) {
                        event.stopPropagation();
                        <?php if(!isset($_SESSION['authenticated'])): ?>
                            window.location.href = './function/authentication.php';
                        <?php else: ?>
                            event.stopPropagation();
                            var addToCartModal = document.getElementById('addToCartModal<?php echo $row['id']; ?>');
                        <?php endif; ?>
                    }             

    function resetModal(productId) {
        // Unselect all sizes
        var checkboxes = document.querySelectorAll("[id^='" + productId + "_']");
        checkboxes.forEach(function(checkbox) {
            checkbox.classList.remove("checked");
        });

        // Reset total price to 0
        var foodPrice = document.getElementById("totalPrice" + productId);
        foodPrice.textContent = "0.00";

        // Reset quantity to 1
        var numberField = document.getElementById("numberField" + productId);
        numberField.value = "1";

    }

    function addToCartAndReset(productId) {
        addToCartAuthenticate(productId);
        resetModal(productId);
        $('#addToCartModal' + productId).modal('toggle');
    }

    function decrease(productId) {
        var numberField = document.getElementById("numberField" + productId);
        var currentValue = parseInt(numberField.value);
        if (!isNaN(currentValue) && currentValue > 1) {
            numberField.value = currentValue - 1;
            updatePrice(productId);
        }
    }

    function increase(productId) {
        var numberField = document.getElementById("numberField" + productId);
        var currentValue = parseInt(numberField.value);
        if (!isNaN(currentValue)) {
            numberField.value = currentValue + 1;
            updatePrice(productId);
        }
    }

    function toggleCheck(size, price) {
        var parts = size.split('_');
        var productId = parts[0];
        var checkboxes = document.querySelectorAll("[id^='" + productId + "_']");
        checkboxes.forEach(function(checkbox) {
            checkbox.classList.remove("checked");
        });
        var checkbox = document.getElementById(size);
        checkbox.classList.add("checked");
        updatePrice(productId);
    }

    function updatePrice(productId) {
        var numberField = document.getElementById("numberField" + productId);
        var quantity = parseInt(numberField.value);
        var selectedSize = document.querySelector('.check-button.checked');
        if (!selectedSize) return;
        var basePrice = parseFloat(selectedSize.querySelector('input').getAttribute('data-price'));
        if (isNaN(basePrice)) return;
        var totalPrice = basePrice * quantity;
        var foodPrice = document.getElementById("totalPrice" + productId);
        foodPrice.textContent = totalPrice.toLocaleString('en-US', { minimumFractionDigits: 2 });
    }

    
    function addToCart(productId) {
    var productImage = document.querySelector('#addToCartModal' + productId + ' .item-display').getAttribute('src');
    var productName = document.querySelector('#addToCartModal' + productId + ' .food-namemod').textContent;
    var quantity = parseInt(document.querySelector('#numberField' + productId).value);
    var selectedSize = document.querySelector('.check-button.checked');
    var totalPrice = parseFloat(selectedSize.querySelector('input').getAttribute('data-price')) * quantity; // Calculate total price
    var totalPriceElement = document.getElementById("totalPrice" + productId);
    var formattedTotalPrice = totalPriceElement.textContent; // Fetch formatted total price
    var unformattedTotalPrice = parseFloat(totalPriceElement.getAttribute('data-total-price')); // Fetch unformatted total price
    var sizePrice = parseFloat(selectedSize.querySelector('input').getAttribute('data-price')); // Fetch size price

    if (!selectedSize) {
        alert('Please select a size.');
        return;
    }

    if (totalPrice == 0) {
        alert('Please select a size');
        return;
    }

    $('#addToCartModal' + productId).modal('hide');
    
    var size = selectedSize.textContent.split('-')[0].trim();
    
    var item = {
        productId: productId,
        productImage: productImage,
        productName: productName,
        quantity: quantity,
        size: size,
        sizePrice: sizePrice, // Include size price in the item object
        totalPrice: totalPrice
    };

    console.log('Item:', item);
    
    // Send data to server using AJAX
    $.ajax({
        type: 'POST',
        url: './function/addToCart.php',
        data: { item: JSON.stringify(item) },
        success: function(response) {
            // Handle success
            console.log('Item added to cart successfully!');
            // Show confirmation modal
            $('#itemAddedModal').modal('show');
            // Close confirmation modal after 3 seconds
            setTimeout(function() {
                $('#itemAddedModal').modal('hide');
                // Refresh the page after successful add to cart
                window.location.reload();
                // Reset the modal after successful add to cart
                 resetModal(productId);
            }, 2000);
           
        },
        error: function(error) {
            // Handle error
            console.error('Error adding item to cart:', error);
            // Show error modal
            $('#errorModal').modal('show');
            // Close error modal after 3 seconds
            setTimeout(function() {
                $('#errorModal').modal('hide');
            }, 2000);
        }
    });
}
</script>

        <?php
            }
                } else {?>
        <p class="food-name">No Products Found</p>
        <?php } ?>
        </div> 
    </div>
 </div>



<script>
    function filterProducts() {
        var input, filter, menuItems, item, productName;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        menuItems = document.getElementsByClassName("menu-item");

        for (var i = 0; i < menuItems.length; i++) {
            item = menuItems[i];
            productName = item.querySelector(".food-name").innerText.toUpperCase();
            if (productName.indexOf(filter) > -1) {
                item.style.display = "";
            } else {
                item.style.display = "none";
            }
        }
    }
</script>



    <!--Menu item-->
    <?php include('common/footer.php');?>
    <!-- End Code -->
  </body>
</html>