<?php
session_start();
include('dbcon.php');
$pid=intval($_GET['pid']);
$ret = mysqli_query($con, "SELECT p.*, c.categoryName, s.subcategory
                            FROM products p
                            INNER JOIN category c ON p.category = c.id
                            INNER JOIN subcategory s ON p.subCategory = s.id
                            WHERE p.id='$pid'");
while ($row = mysqli_fetch_array($ret)) {
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="./css/navbar.css" />
    <link rel="stylesheet" type="text/css" href="./css/orderelement.css" />
    <title><?php echo htmlentities($row['productName']); ?></title>
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
    .check-button input[type="radio"] {
        display: none;
        }
    </style>
  <?php include('common/navbar.php');?>
    <!-- Code zone -->

    <div class="order-list">
      <div class="order-item">
        <img src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" alt="food" class="item-display" />

        <div class="details">
          <form action="/action_page.php">
            <div class="labels">
              <!-- <p style="margin-right: 59%; margin-left: 2px">Name</p> -->
              <!-- <p>Price</p> -->
            </div>
            <div style="display: flex">
              <p class="food-name"><?php echo htmlentities($row['productName']); ?></p>
              <p class="food-price">PHP <?php echo number_format($row['mediumPrice'], 2); ?></p>
            </div>

            <div class="labels">
              <!-- <p
                style="margin-right: 56%; margin-left: 2px; margin-bottom: 12px"
              >
                Description
              </p> -->
            </div>
            <p class="description">
             <?php echo htmlentities($row['productDescription']); ?>
            </p>
            <div class="buttons">
              <br />
              <img
                src="./img/minus-circle.png"
                alt="Decrease"
                class="btn"
                onclick="decrease()"
              />
              <input
                type="text"
                id="numberField"
                value="1"
                readonly
                style="width: 50px; text-align: center; border-radius: 14px"
              />
              <img
                src="./img/add.png"
                alt="Increase"
                class="btn"
                onclick="increase()"
              />
            </div>
            <br />
            <div class="buttons">
              <div class="button-group">
                <!-- Set the medium button as checked by default -->
                <label class="check-button checked" id="medium">
                  <input type="radio" name="size" checked data-price="<?php echo htmlentities($row['mediumPrice']); ?>" onchange="toggleCheck('medium', <?php echo htmlentities($row['mediumPrice']); ?>)" />
                  Medium
                </label>
                <label class="check-button" id="large">
                  <input type="radio" name="size" data-price="<?php echo htmlentities($row['largePrice']); ?>" onchange="toggleCheck('large', <?php echo htmlentities($row['largePrice']); ?>)" />
                  Large
                </label>
                <label class="check-button" id="xlarge">
                  <input type="radio" name="size"  data-price="<?php echo htmlentities($row['xlPrice']); ?>" onchange="toggleCheck('xlarge', <?php echo htmlentities($row['xlPrice']); ?>)" />
                  XLarge
                </label>
                <label class="check-button" id="xxlarge">
                  <input type="radio" name="size" data-price="<?php echo htmlentities($row['xxlPrice']); ?>" onchange="toggleCheck('xxlarge', <?php echo htmlentities($row['xxlPrice']); ?>)" />
                  XXLarge
                </label>
              </div>
            </div>
            <div class="buttons">
              <input type="button" value="Cancel" class="add-item" onclick="goBack()" />
              <input type="submit" value="Add To Cart" class="add-item" />
            </div>
          </form>
        </div>
      </div>
    </div>


    <script>
function goBack() {
    window.history.back();
}
</script>

    <script>
function decrease() {
    var numberField = document.getElementById("numberField");
    var currentValue = parseInt(numberField.value);
    if (!isNaN(currentValue) && currentValue > 1) {
        numberField.value = currentValue - 1;
        updatePrice(); // Call updatePrice() to update the total price
    }
}

function increase() {
    var numberField = document.getElementById("numberField");
    var currentValue = parseInt(numberField.value);
    if (!isNaN(currentValue)) {
        numberField.value = currentValue + 1;
        updatePrice(); // Call updatePrice() to update the total price
    }
}

function toggleCheck(size, price) {
    var checkbox = document.getElementById(size);
    var checkboxes = document.querySelectorAll(".check-button");

    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].classList.remove("checked");
    }

    if (checkbox.querySelector("input").checked) {
        checkbox.classList.add("checked");
        // Update the price display based on the selected size and quantity
        updatePrice(price);
    }
}

function updatePrice() {
    var numberField = document.getElementById("numberField");
    var quantity = parseInt(numberField.value);
    var foodPrice = document.querySelector(".food-price");

    var selectedSize = document.querySelector('.check-button.checked');
    if (!selectedSize) return; // Exit if no size is selected

    var basePrice = parseFloat(selectedSize.querySelector('input').getAttribute('data-price'));
    if (isNaN(basePrice)) return; // Exit if base price is not valid

    var totalPrice = basePrice * quantity;
    foodPrice.textContent = "PHP " + totalPrice.toFixed(2); // Format price with 2 decimal places
}
</script>
    <!-- End Code -->
  </body>
</html>
<?php } ?>