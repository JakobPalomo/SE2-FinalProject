<?php
session_start();
include('dbcon.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="./css/navbar.css"/>
    <link rel="stylesheet" type="text/css" href="./css/mycart.css"/>
    <link rel="stylesheet" type="text/css" href="./css/menuelement.css"/>
    <title>Document</title>
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
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
            href="https://fonts.googleapis.com/css2?family=Inika&family=Plus+Jakarta+Sans&display=swap"
            rel="stylesheet"
    />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    // Function to remove an item using AJAX
    function removeCartItem(index) {
        $.ajax({
            type: 'POST',
            url: './function/removeCartItem.php', // Update the URL to the server-side script
            data: { index: index },
            success: function(response) {
                // Update the cart on the client side (remove the item from the DOM)
                $('#cart-item-' + index).remove();
            },
            error: function(error) {
                console.error('Error removing item:', error);
            }
        });
    }
</script>
</head>


<body style="background-color: #f5f5dc">
<?php include('common/navbar.php'); ?>
<div class="maintitle">
      <p class="title">My Cart</p>
    </div>

<div class="order-list">

<?php
    // Example cart display code
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $index => $item) {
            $productId = $item['productId'];
            $query = "SELECT productName, mediumPrice, largePrice, xlPrice, xxlPrice, productImage1 FROM products WHERE id = $productId";
            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $productDetails = mysqli_fetch_assoc($result);
                $productName = $productDetails['productName'];
                $productImage = $productDetails['productImage1'];

                // Modify to dynamically select price based on size
                switch ($item['size']) {
                    case 'M':
                        $price = $productDetails['mediumPrice'];
                        break;
                    case 'L':
                        $price = $productDetails['largePrice'];
                        break;
                    case 'XL':
                        $price = $productDetails['xlPrice'];
                        break;
                    case 'XXL':
                        $price = $productDetails['xxlPrice'];
                        break;
                    default:
                        $price = 0;
                        break;
                }
            } else {
                $productName = "Product not found";
                $price = 0;
            }

            // Display cart item details
            echo '<div class="cart-item" id="cart-item-' . $index . '">';
            echo '<img src="admin/productimages/' . $productId . '/' . $productImage . '" alt="food" class="cart-display" />';
            echo '<div class="detail-cart">';
            echo "<p class=\"foodcart-name\">{$productName}</p>";
            echo "<p class=\"foodcart-name\">";
            echo '<button class="amount">-</button> ' . $item['quantity'] . ' <button class="amount">+</button>';
            echo '</p>';
            echo '</div>';
            echo '<div class="price">';
            echo "<p class=\"total-price\">₱" . number_format($price * $item['quantity'], 2) . '</p>';
            echo '<img src="./img/cross-circle (2).png" alt="food" width="24px" height="24px" style="cursor: pointer;" onclick="removeCartItem(' . $index . ')" />';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p>Your cart is empty.</p>";
    }

  
    ?>

<div class="subtitle">
      <p class="subtitle-txt-2">Date of Preparation</p>
    </div>
    <div class="subtitle" style="margin-bottom: 200px">
      <p class="subtitle-txt-bg-2">April 25. 2024</p>
    </div>
    <!-- FOOTER -->
    <footer>
      <div class="footer-columns">
        <!-- TOTAL PRICE -->
        <div class="footer-column">
          <h8>Total Price</h8>
          <p class="subtitle-txt-2">P 1,000.00</p>
        </div>
        <!-- CHECKBOXES -->
        <div class="footer-column">
          <div class="checkbox-container">
            <label class="checkbox-label" for="deliveryCheckbox">
              <input
                type="checkbox"
                id="deliveryCheckbox"
                class="custom-checkbox"
                onclick="handleCheckboxClick('deliveryCheckbox')"
              />
              <div class="checkmark"></div>
              Delivery</label
            >
          </div>
          <div class="checkbox-container">
            <label class="checkbox-label" for="pickupCheckbox">
              <input
                type="checkbox"
                id="pickupCheckbox"
                class="custom-checkbox"
                onclick="handleCheckboxClick('pickupCheckbox')"
              />
              <div class="checkmark"></div>
              Pickup</label
            >
          </div>
        </div>
        <!-- CHECKOUT BUTTON -->
        <div class="footer-column">
          <div class="cart-checkout">
            <button class="cart-checkout-btn">Checkout</button>
          </div>
        </div>
      </div>
      <!-- END OF FOOTER -->
      
      
      <!-- JAVASCRIPT FOR CHECKBOX -->
      <script>
        function handleCheckboxClick(clickedCheckboxId) {
          const checkboxes = ["deliveryCheckbox", "pickupCheckbox"];

          checkboxes.forEach((checkboxId) => {
            const checkbox = document.getElementById(checkboxId);
            const checkmark = checkbox.nextElementSibling;

            if (checkboxId === clickedCheckboxId) {
              checkbox.checked = true;
              checkmark.style.display = "block";
            } else {
              checkbox.checked = false;
              checkmark.style.display = "none";
            }
          });
        }
      </script>
      
    </footer>

</div>
</body>
</html>