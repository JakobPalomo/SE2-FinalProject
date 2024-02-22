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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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

</head>

<body style="background-color: #f5f5dc;  margin-bottom: 200px;">
    <?php include('common/navbar.php'); ?>

    <div class="maintitle">
        <p class="title">My Cart</p>
    </div>

    <div class="order-list">
    <?php
    $totalPrice = 0;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $index => $item) {
            echo '<div class="cart-item" id="cart-item-' . $index . '">';
            echo '<img src="' . $item['productImage'] . '" alt="food" class="cart-display" />';
            echo '<div class="detail-cart">';
            echo '<p class="foodcart-name">' . $item['productName'] . '</p>';
            echo '<p class="foodcart-name">' . $item['quantity'] . ' - ' . $item['size'] . ' ($' . $item['sizePrice'] . ')</p>';
            echo '</div>';
            echo '<div class="price">';
            echo '<p class="total-price">₱' . $item['totalPrice'] . '</p>';
            echo '<img src="./img/cross-circle (2).png" alt="food" width="24px" height="24px" style="cursor: pointer;" onclick="removeCartItem(' . $index . ')" />';
            echo '</div>';
            echo '</div>';
            
            // Calculate total price
            $totalPrice += $item['totalPrice'];
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

        <div class="subtitle">
    <p class="subtitle-txt-2">Time of Delivery</p>
</div>
<div class="subtitle" style="margin-bottom: 20px">
    <input type="time" id="timepicker" name="preparationTime" class="subtitle-txt-bg-2">
</div>

        <!-- Address Field -->
        <div class="subtitle">
            <span class="linebreak"><p class="subtitle-txt-2">Delivery Address</p></span>
            <span class="linebreak"><button class="change-btn" data-bs-toggle="modal" data-bs-target="#changeAddressModal">Change</button></span>
        </div>
        <div class="subtitle" style="margin-bottom: 20px">
            <p class="subtitle-txt-bg-2" id="userAddress" ><?php echo $_SESSION['auth_user']['address']; ?></p>
        </div>

        <!-- FOOTER -->
        <footer class="footer">
        <div class="container">
            <div class="footer-columns">

            <!-- COLUMN 1 -->
                <div class="footer-column">
                    <h8>Total Price</h8>
                    <p class="subtitle-txt-2"><?php echo number_format($totalPrice, 2); ?></p>
                </div>
                <!-- COLUMN 2 -->
               
<div class="footer-column">
    <div class="checkbox-container">
        <label class="checkbox-label" for="deliveryCheckbox">
            <input type="checkbox" id="deliveryCheckbox" class="custom-checkbox" name="deliveryOption" onclick="handleCheckboxClick('deliveryCheckbox')" value="Delivery" />
            <div class="checkmark"></div> Delivery
        </label>
    </div>
    <div class="checkbox-container">
        <label class="checkbox-label" for="pickupCheckbox">
            <input type="checkbox" id="pickupCheckbox" class="custom-checkbox" name="deliveryOption" onclick="handleCheckboxClick('pickupCheckbox')" value="Pickup"/>
            <div class="checkmark"></div> Pickup
        </label>
    </div>
</div>

<div class="footer-column">
    <div class="checkbox-container">
        <label class="checkbox-label" for="codCheckbox">
            <input type="checkbox" id="codCheckbox" class="custom-checkbox" name="paymentOption" onclick="handlePaymentCheckboxClick('codCheckbox')" value="COD" />
            <div class="checkmark"></div> Cash on Delivery
        </label>
    </div>
    <div class="checkbox-container">
        <label class="checkbox-label" for="gcashCheckbox">
            <input type="checkbox" id="gcashCheckbox" class="custom-checkbox" name="paymentOption" onclick="handlePaymentCheckboxClick('gcashCheckbox')" value="Gcash" />
            <div class="checkmark"></div> Gcash
        </label>
    </div>
</div>


             
                <!-- COLUMN 4 -->
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
            if (checkboxId !== clickedCheckboxId) {
                const checkbox = document.getElementById(checkboxId);
                const checkmark = checkbox.nextElementSibling;
                checkbox.checked = false;
                checkmark.style.display = "none";
            }
        });

        const clickedCheckbox = document.getElementById(clickedCheckboxId);
        const checkmark = clickedCheckbox.nextElementSibling;
        clickedCheckbox.checked = true;
        checkmark.style.display = "block";

        console.log('Selected delivery option:', clickedCheckbox.value);
    }




    function handlePaymentCheckboxClick(clickedCheckboxId) {
        const checkboxes = ["codCheckbox", "gcashCheckbox"];
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

            $('#timepicker').timepicker({
            timeFormat: 'HH:mm',    // Change the time format if needed
            step: 15                // Set the time step to 15 minutes
        });

            // Handle checkbox clicks for payment options
            $('input[name="paymentOption"]').on('change', function () {
                console.log('Selected payment option:', $(this).val());
            });

            $('input[name="deliveryOption"]').on('change', function () {
            console.log('Selected delivery option:', $(this).val());
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
            // Check if the date field is empty
            var preparationDate = $('#datepicker').val();
            if (!preparationDate) {
                alert('Please select a preparation date.');
                return;
            }
            var deliveryTime = $('#timepicker').val();
            if (!deliveryTime) {
                alert('Please select a time for delivery.');
                return;
            }
            var deliveryOption = $('input[name="deliveryOption"]:checked').val();
            if (!deliveryOption) {
                alert('Please select a delivery option.');
                return;
            }
            // Check if only one payment option is selected
            var paymentOption = $('input[name="paymentOption"]:checked').val();
            if (!paymentOption) {
                alert('Please select a payment option.');
                return;
            }
            var userAddress = $('#userAddress').text();
           

            // Call the placeOrder.php script using AJAX
            $.ajax({
                type: 'POST',
                url: './function/placeOrder.php',
                data: {
                    paymentOption: paymentOption,
                    deliveryOption: deliveryOption,
                    preparationDate: $('#datepicker').val(),
                    deliveryTime:$('#timepicker').val(),
                    totalPrice: totalPrice ,
                    userAddress: userAddress
                },
                success: function (response) {
                    // Display the response (you can update this part based on your UI requirements)
                    alert(response);
                    window.location.href = 'user-account.php?scrollToCard2=true';
                },
                error: function (error) {
                    console.error('Error placing order:', error);
                }
            });
        } else {
            alert('Invalid total price format');
        }
    });

    // Handle checkbox clicks for payment options
    $('input[name="paymentOption"]').on('change', function () {
        console.log('Selected payment option:', $(this).val());
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
