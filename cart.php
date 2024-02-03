<?php
session_start();
include('./dbcon.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>My Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="./css/navbar.css" />
    <link rel="stylesheet" type="text/css" href="./css/mycart.css" />
    <link rel="stylesheet" type="text/css" href="./css/menuelement.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Inika&family=Plus+Jakarta+Sans&display=swap" rel="stylesheet" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>


    <script>
    function updateAddress() {
        console.log('Update address function called');

        // Get values from the modal
        var buildingNumber = $('#buildingNumber').val();
        var streetBarangay = $('#streetBarangay').val();
        var cityMunicipality = $('#cityMunicipality').val();
        var province = $('#province').val();
        var postalCode = $('#postalCode').val();

        console.log('Values from modal:', buildingNumber, streetBarangay, cityMunicipality, province, postalCode);

        // Check if any field is empty
        if (!buildingNumber || !streetBarangay || !cityMunicipality || !province || !postalCode) {
            // Display an error message or handle it
            alert('Please fill in all address fields.');
            console.log('Address update failed: Empty field(s)');
            return;
        }

        // Concatenate the fields with a comma
        var updatedAddress = buildingNumber + ', ' + streetBarangay + ', ' + cityMunicipality + ', ' + province + ', ' + postalCode;

        console.log('Updated Address:', updatedAddress);

        // Update the delivery address on the page
        $('.subtitle-txt-bg-2').text(updatedAddress);

        // Close the modal
        document.getElementById('changeAddressModal').style.display = 'none';
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();

        console.log('End of updateAddress function');
    }
</script>

    <script>
        // Function to remove an item using AJAX
        function removeCartItem(index) {
            $.ajax({
                type: 'POST',
                url: './function/removeCartItem.php', // Update the URL to the server-side script
                data: {
                    index: index
                },
                success: function (response) {
                    // Update the cart on the client side (remove the item from the DOM)
                    $('#cart-item-' + index).remove();
                },
                error: function (error) {
                    console.error('Error removing item:', error);
                }
            });
        }
    </script>
    <script>
        function updateCartItem(index, newSize, newQuantity) {
            $.ajax({
                type: 'POST',
                url: './function/updateCartItem.php', // Update the URL to the server-side script
                data: {
                    index: index,
                    newSize: newSize,
                    newQuantity: newQuantity
                },
                success: function (response) {
                    // Update the cart on the client side (update the item's details)
                    // Assuming the server sends back updated details, you can parse and update accordingly
                    var updatedDetails = JSON.parse(response);
                    var updatedPrice = updatedDetails.price * updatedDetails.quantity;
                    $('#cart-item-' + index + ' .total-price').text('₱' + updatedPrice.toFixed(2));
                },
                error: function (error) {
                    console.error('Error updating item:', error);
                }
            });
        }

        function incrementQuantity(index, size) {
            var quantityDisplay = $('#cart-item-' + index + ' .quantity-display');
            var currentQuantity = parseInt(quantityDisplay.text(), 10);
            updateCartItem(index, size, currentQuantity + 1);
            quantityDisplay.text(currentQuantity + 1);
        }

        function decrementQuantity(index, size) {
            var quantityDisplay = $('#cart-item-' + index + ' .quantity-display');
            var currentQuantity = parseInt(quantityDisplay.text(), 10);
            if (currentQuantity > 1) {
                updateCartItem(index, size, currentQuantity - 1);
                quantityDisplay.text(currentQuantity - 1);
            }
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
              $totalPrice = 0;
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
                    $totalPrice += $price * $item['quantity'];
                } else {
                    $productName = "Product not found";
                    $price = 0;
                }

                // Display cart item details
                echo '<div class="cart-item" id="cart-item-' . $index . '">';
                echo '<img src="admin/productimages/' . $productId . '/' . $productImage . '" alt="food" class="cart-display" />';
                echo '<div class="detail-cart">';
                echo "<p class=\"foodcart-name\">{$productName}</p>";

                echo '<button onclick="decrementQuantity(' . $index . ', \'' . $item['size'] . '\')">-</button>';
                echo '<span class="quantity-display">' . $item['quantity'] . '</span>';
                echo '<button onclick="incrementQuantity(' . $index . ', \'' . $item['size'] . '\')">+</button>';

                echo '<select class="size-dropdown" onchange="updateCartItem(' . $index . ', this.value, ' . $item['quantity'] . ')">';
                echo '<option value="M" ' . ($item['size'] === 'M' ? 'selected' : '') . '>M</option>';
                echo '<option value="L" ' . ($item['size'] === 'L' ? 'selected' : '') . '>L</option>';
                echo '<option value="XL" ' . ($item['size'] === 'XL' ? 'selected' : '') . '>XL</option>';
                echo '<option value="XXL" ' . ($item['size'] === 'XXL' ? 'selected' : '') . '>XXL</option>';
                echo '</select>';
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
        <!-- Datepicker -->
        <div class="subtitle">
            <p class="subtitle-txt-2">Date of Preparation</p>
        </div>
        <div class="subtitle" style="margin-bottom: 20px">
            <input type="date" id="datepicker" name="preparationDate" class="subtitle-txt-bg-2">
        </div>

        <!-- Address Field -->
        <div class="subtitle">
            <p class="subtitle-txt-2">Delivery Address</p>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeAddressModal">Change</button>
        </div>
        <div class="subtitle" style="margin-bottom: 20px">
            <p class="subtitle-txt-bg-2"><?php echo $_SESSION['auth_user']['address']; ?></p>
        </div>

        <!-- FOOTER -->
        <footer class="footer">
        <div class="container">
            <div class="footer-columns">
                <div class="footer-column">
                    <h8>Total Price</h8>
                    <p class="subtitle-txt-2"><?php echo number_format($totalPrice, 2); ?></p>
                </div>
                <div class="footer-column">
                    <div class="checkbox-container">
                        <label class="checkbox-label" for="deliveryCheckbox">
                            <input type="checkbox" id="deliveryCheckbox" class="custom-checkbox" onclick="handleCheckboxClick('deliveryCheckbox')" />
                            <div class="checkmark"></div> Delivery</label>
                    </div>
                    <div class="checkbox-container">
                        <label class="checkbox-label" for="pickupCheckbox">
                            <input type="checkbox" id="pickupCheckbox" class="custom-checkbox" onclick="handleCheckboxClick('pickupCheckbox')" />
                            <div class="checkmark"></div> Pickup</label>
                    </div>
                </div>
                <div class="footer-column">
                    <div class="subtitle">
                        <p class="subtitle-txt-2">Payment Options</p>
                    </div>
                    <div class="subtitle" style="margin-bottom: 20px">
                        <div class="checkbox-container">
                            <label class="checkbox-label" for="codCheckbox">
                                <input type="checkbox" id="codCheckbox" class="custom-checkbox" name="paymentOption" value="COD" />
                                <div class="checkmark"></div> Cash on Delivery</label>
                        </div>
                        <div class="checkbox-container">
                            <label class="checkbox-label" for="gcashCheckbox">
                                <input type="checkbox" id="gcashCheckbox" class="custom-checkbox" name="paymentOption" value="Gcash" />
                                <div class="checkmark"></div> Gcash</label>
                        </div>
                    </div>
                </div>
                <div class="footer-column">
                    <div class="cart-checkout">
                        <button class="cart-checkout-btn" id="placeOrderBtn">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
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

    </div>
    <script>
        $(function () {
            // Initialize datepicker
            $("#datepicker").datepicker({
                dateFormat: "MM dd, yy",
                minDate: 0, // Set the minimum date to today
                onSelect: function (dateText) {
                    // You can perform additional actions when a date is selected
                    console.log("Selected date: " + dateText);
                }
            });

            // Handle checkbox clicks for payment options
            $('input[name="paymentOption"]').on('change', function () {
                console.log('Selected payment option:', $(this).val());
            });
        });
 </script>

<script>
    $(document).ready(function () {
        // Handle the "Place Order" button click
        $('#placeOrderBtn').on('click', function () {
            // Get the total price value
            var totalPrice = <?php echo $totalPrice; ?>;

            // Check if totalPrice is a valid number
            if (!isNaN(totalPrice)) {
                // Call the placeOrder.php script using AJAX
                $.ajax({
                    type: 'POST',
                    url: './function/placeOrder.php',
                    data: {
                        paymentOption: $('input[name="paymentOption"]:checked').val(),
                        deliveryCheckbox: $('#deliveryCheckbox').prop('checked'),
                        pickupCheckbox: $('#pickupCheckbox').prop('checked'),
                        preparationDate: $('#datepicker').val(),
                        totalPrice: totalPrice  // Pass the total price
                    },
                    success: function (response) {
                        // Display the response (you can update this part based on your UI requirements)
                        alert(response);
                    },
                    error: function (error) {
                        console.error('Error placing order:', error);
                    }
                });
            } else {
                alert('Invalid total price format');
            }
        });
    });
</script>




</body>

<!-- Modal Change Address -->
<div class="modal" id="changeAddressModal" tabindex="-1" aria-labelledby="changeAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addressModalLabel">Update Delivery Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Address fields in the modal -->
                <div class="mb-3">
                    <label for="buildingNumber" class="form-label">Building/ House Number</label>
                    <input type="text" class="form-control" id="buildingNumber">
                </div>
                <div class="mb-3">
                    <label for="streetBarangay" class="form-label">Street Barangay</label>
                    <input type="text" class="form-control" id="streetBarangay">
                </div>
                <div class="mb-3">
                    <label for="cityMunicipality" class="form-label">City/Municipality</label>
                    <input type="text" class="form-control" id="cityMunicipality">
                </div>
                <div class="mb-3">
                    <label for="province" class="form-label">Province</label>
                    <input type="text" class="form-control" id="province">
                </div>
                <div class="mb-3">
                    <label for="postalCode" class="form-label">Postal Code</label>
                    <input type="text" class="form-control" id="postalCode">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateAddress()">Save changes</button>
            </div>
        </div>
    </div>
</div>
</html>
