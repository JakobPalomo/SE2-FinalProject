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
    <link rel="shortcut icon" type="x-icon" href="./img/logomini.png">
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
    function showAlertModal(message) {
        $('#alertModalBody').text(message);
        $('#alertModal').modal('show');
    }

    function updateAddress() {
        console.log('Update address function called');

        // Get values from the modal
        var buildingNumber = $('#buildingNumber').val();
        var street = $('#street').val();
        var barangay = $('#barangay').val();
        var cityMunicipality = $('#cityMunicipality').val();
        var province = $('#province').val();
        var postalCode = $('#postalCode').val();

        

        // Check if any field is empty
        if (!buildingNumber || !street || !barangay || !cityMunicipality || !province || !postalCode) {
            // Display an error message or handle it
            showAlertModal('Please fill in all address fields.');
            console.log('Address update failed: Empty field(s)');
            return;
        }

        // Concatenate the fields with a comma
        var updatedAddress = buildingNumber + ', ' + street + ', ' + barangay + ', ' + cityMunicipality + ', ' + province + ', ' + postalCode;

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
                    // Reload the window
                     window.location.reload();
                },
                error: function (error) {
                    console.error('Error removing item:', error);
                }
            });
        }
    </script>

<script>
    // Function to show confirmation modal before removing an item
    function showConfirmationModal(index) {
        $('#confirmRemoveBtn').off('click').on('click', function() {
            removeCartItem(index); // Proceed with removal if confirmed
            $('#confirmationModal').modal('hide'); // Hide the confirmation modal
        });
        $('#confirmationModal').modal('show'); // Show the confirmation modal
    }
</script>

<script>
    // Function to remove an item using AJAX
    function removeCartItemCon(index) {
        showConfirmationModal(index); // Show confirmation modal
        // AJAX removal process is moved inside showConfirmationModal function
    }
</script>

</head>

<body style="background-color: #f5f5dc;  margin-bottom: 200px;" class="apply-padding">
    <?php include('common/navbar.php'); ?>

    <div class="maintitle">
        <p class="title">My Cart</p>
    </div>

    <div class="order-list">
    <?php
        $totalPrice = 0;
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $index => $item) { ?>
                <div class="cart-item" id="cart-item-<?php echo $index; ?>">
                    <img src="<?php echo $item['productImage']; ?>" alt="food" class="cart-display" />
                    <div class="detail-cart">
                        <p class="foodcart-name"><?php echo $item['productName']; ?></p>
                        <p class="foodcart-name"><?php echo $item['quantity']; ?> - <?php echo $item['size']; ?> (₱<?php echo number_format($item['sizePrice'], 2, '.', ','); ?>)</p>
                    </div>
                    <div class="price">
                        <p class="total-price">₱<?php echo number_format($item['totalPrice'], 2, '.', ','); ?></p>
                        <img src="./img/cross-circle (2).png" alt="food" width="24px" height="24px" style="cursor: pointer;" onclick="removeCartItemCon(<?php echo $index; ?>)" />
                    </div>
                </div>
        <?php
                // Calculate total price
                $totalPrice += $item['totalPrice'];
            }
        } else {
            echo "<p>Your cart is empty.</p>";
        }
    ?>

        <!-- Datepicker -->
        <br>
        <br>
        <div class="subtitle">
            <p class="subtitle-txt-2" style="text-align: center;">Date of Delivery</p>
            <p class="subtitle-txt-3">(Set at least <u>3 days</u> in advance)</p>
        </div>
        <div class="subtitle" style="margin-bottom: 20px">
            <input type="date" id="datepicker" name="preparationDate" class="subtitle-txt-bg-2">
        </div>

        <br>
        <div class="subtitle">
            <p class="subtitle-txt-2">Time of Delivery</p>
        </div>
        <div class="subtitle" style="margin-bottom: 20px">
            <input type="time" id="timepicker" name="preparationTime" class="subtitle-txt-bg-2">
        </div>

        <!-- Address Field -->
        <br>
        <div class="subtitle">
            <span class="linebreak" style="margin-right: 10px;"><p class="subtitle-txt-2">Delivery Address</p></span>
            
        </div>
        <div class="subtitle">
            <span class="linebreak"><button class="change-btn" data-bs-toggle="modal" data-bs-target="#changeAddressModal">Change</button></span><br>
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
                    <p class="subtitle-txt-2">₱<?php echo number_format($totalPrice, 2, '.', ','); ?></p>
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
            <div class="checkmark"></div> Cash
        </label>
    </div>
    <div class="checkbox-container">
        <label class="checkbox-label" for="gcashCheckbox">
            <input type="checkbox" id="gcashCheckbox" class="custom-checkbox" name="paymentOption" onclick="handlePaymentCheckboxClick('gcashCheckbox')" value="Gcash" />
            <div class="checkmark"></div> GCash
            <p class="subtitle-txt-3" style="font-size: 10px; margin-top: 0px; margin-bottom:-20px">(Gcash must be paid within <u>3 days</u>)</p>
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
        minDate: getMinDate(), // Set the minimum date based on the number of items
        onSelect: function (dateText) {
            // You can perform additional actions when a date is selected
            console.log("Selected date: " + dateText);
        }
    });

    $('#timepicker').timepicker({
        timeFormat: 'HH:mm',    // Change the time format if needed
        step: 15                // Set the time step to 15 minutes
    });

    // Function to calculate the minimum date based on the number of items
    function getMinDate() {
        var currentDate = new Date();
        var itemCount = <?php echo count($_SESSION['cart']); ?>;
        var minDate;
        if (itemCount <= 11) {
            minDate = new Date(currentDate.setDate(currentDate.getDate() + 3)); // Add 3 days
        } else {
            minDate = new Date(currentDate.setDate(currentDate.getDate() + 5)); // Add 5 days
        }
        return minDate;
    }

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
                showAlertModal('Please select a preparation date.');
                return;
            }
            var deliveryTime = $('#timepicker').val();
            if (!deliveryTime) {
                showAlertModal('Please select a time for delivery.');
                return;
            }
            var deliveryOption = $('input[name="deliveryOption"]:checked').val();
            if (!deliveryOption) {
                showAlertModal('Please select a delivery option.');
                return;
            }
            // Check if only one payment option is selected
            var paymentOption = $('input[name="paymentOption"]:checked').val();
            if (!paymentOption) {
                showAlertModal('Please select a payment option.');
                return;
            }
            var userAddress = $('#userAddress').text();

            // Calculate the minimum preparation date based on the number of items in the cart
            var minPreparationDate = getMinPreparationDate();
            if (new Date(preparationDate) < minPreparationDate) {
                showAlertModal('Please select a preparation date at least 3 days in advance for 12 or fewer items, or at least 5 days in advance for more than 12 items.');
                return;
            }

            // Call the placeOrder.php script using AJAX
            $.ajax({
                type: 'POST',
    url: './function/placeOrder.php',
    data: {
        paymentOption: paymentOption,
        deliveryOption: deliveryOption,
        preparationDate: preparationDate,
        deliveryTime: deliveryTime,
        totalPrice: totalPrice,
        userAddress: userAddress
    },
    success: function (response) {
                // Display the response in the modal
                $('#alertModalBody2').text(response);
                $('#alertModal2').modal('show');

                // Redirect after a delay
                setTimeout(function(){
                    window.location.href = 'user-account.php?scrollToCard2=true';
                }, 2000); // 2 seconds delay
            },
            error: function (error) {
                console.error('Error placing order:', error);
            }
        });

        // Close the modal when the user clicks on <span> (x)
        $('.btn-close').on('click', function() {
            $('#alertModal2').modal('hide');
        });

        // Close the modal when the user clicks anywhere outside of the modal
        $('#alertModal2').on('hidden.bs.modal', function () {
            // Redirect to user-account.php after closing modal
            window.location.href = 'user-account.php?scrollToCard2=true';
        });
        } else {
            showAlertModal('Invalid total price format');
        }
    });

    // Function to calculate the minimum preparation date based on the number of items
    function getMinPreparationDate() {
    var currentDate = new Date();
    var totalQuantity = 0;

    // Calculate total quantity of items in the cart
    <?php
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            ?>totalQuantity += <?php echo $item['quantity']; ?>;
            <?php
        }
    }
    ?>

    var minPreparationDate;
    if (totalQuantity <= 12) {
        minPreparationDate = new Date(currentDate.setDate(currentDate.getDate() + 3)); // Add 3 days
    } else {
        minPreparationDate = new Date(currentDate.setDate(currentDate.getDate() + 5)); // Add 5 days
    }
    return minPreparationDate;
}



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
    <label for="province" class="form-label">Province</label>
    <select class="form-select" id="province" onchange="populateCities()">
        <option value="">Select Province</option>
        <option value="Pampanga">Pampanga</option>
        <!-- Add other provinces here if needed -->
    </select>
</div>
<div class="mb-3">
    <label for="cityMunicipality" class="form-label">City/Municipality</label>
    <select class="form-select" id="cityMunicipality" onchange="populateBarangays()">
        <option value="">Select City/Municipality</option>
    </select>
</div>
<div class="mb-3">
    <label for="barangay" class="form-label">Barangay</label>
    <select class="form-select" id="barangay">
        <option value="">Select Barangay</option>
    </select>
</div>
<div class="mb-3">
    <label for="postalCode" class="form-label">Postal Code</label>
    <input type="text" class="form-control" id="postalCode" readonly>
</div>
                <div class="mb-3">
                    <label for="buildingNumber" class="form-label">Building/ House Number</label>
                    <input type="text" class="form-control" id="buildingNumber">
                </div>
                <div class="mb-3">
                    <label for="streetBarangay" class="form-label">Street</label>
                    <input type="text" class="form-control" id="street">
                </div>
                
                
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateAddress()" style="background-color: red;">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to remove this item from your cart?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmRemoveBtn">Remove</button>
            </div>
        </div>
    </div>
</div>

<!-- Validation Modal -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel">Warning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="alertModalBody">
                <!-- Validation message will be displayed here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
</html>

<!-- Order Place Modal -->
<div class="modal fade" id="alertModal2" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel">Success!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="alertModalBody2">
                <!-- Validation message will be displayed here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script>
    const addresses = {
          "Pampanga": {
    "Angeles City": {
        barangays: ["Agapito Del Rosario", "Anunas", "Balibago", "Cpaaya", "Claro M. Recto", "Cuayan", "Cutcut", "Cutud", "Lourdes North West", "Lourdes Sur", "Lourdes Sur East", "Malabanas", "Margot", "Mining", "Pampang", "Pandan", "Pulung Maragul", "Pulung Bulu", "Pulung Cacutud", "Salapungan", "San Jose", "San Nicolas", "Sta Teresita", "Sta Trinidad", "Sto Cristo", "Sto Domingo", "Sto Rosario", "Sapalibutad", "Sapang Bato", "Tabun", "Virgen Delos Remedios", "Amsic", "Ninoy Aquino"],
        postal_code: "2009"
    },
    "Apalit": {
        barangays: ["Balucuc","Calantipe", "Cansinala", "Capalangan", "Colgante", "Paligui", "Sampaloc", "San Juan", "San Vicente", "Sucad", "Sulipan", "Tabuyuc"],
        postal_code: "2016"
    },
    "Arayat": {
        barangays: ["Arenas", "Baliti", "Batasan", "Buensuceso", "Candating", "Cupang", "Gatiawin", "Guemasan", "La Paz", "Lacmit", "Lacquios", "Mangga-Cacutud", "Mapalad", "Panlinlang", "Paralay", "Plazang Luma", "Poblacion", "San Agustin Norte", "San Agustin Sur", "San Antonio", "San Jose Mesulo", "San Juan Bano", "San Mateo", "San Nicolas", "San Roque Bitas", "Matamo","Santo Nino Tabuan", "Suclayin", "Telapayong", "Kaledian"],
        postal_code: "2012"
    },
    "Bacolor": {
        barangays: ["Balas", "Cabalantian", "Cabambangan", "Cabetican", "Calibutbut", "Concepcion", "Dolores", "Duat", "Macabacle", "Magliman", "Maliwalu", "Mesalipit", "Parulog", "Potrero", "San Antonio", "San Isidro", "San Vicente", "Santa Barbara", "Santa Ines", "Talba", "Tinajero"],
        postal_code: "2001"
    },
    "Candaba": {
        barangays: ["Bahay Pare", "Bambang", "Barangca", "Barit", "Buas", "Cuayang Bugtong", "Dalayang", "Dulong Ilog", "Gulap", "Lanang", "Lourdes", "Magumbali", "Mandasig", "Mandili", "Mangga", "Mapaniqui", "Paligui", "Pangclara", "Pansinao", "Paralaya", "Pasig", "Pescadores", "Pulong Gubat", "Pulong Palazan", "Salapungan", "San Agustin", "Santo Rosario", "Tagulod", "Talang", "Tenejero", "Vizal San Pedro", "Vizal Santo Cristo", "Vizal Santo Nino"],
        postal_code: "2013"
    },
    "Floridablanca": {
        barangays: ["Anon", "Apalit", "Basa Air Base", "Benedicto", "Bodega", "Cabangcalan", "Calantas", "Carmencita", "Consuelo", "Dampe", "Del Carmen", "Fortuna", "Gutad", "Mabical", "Sto Rosario", "Maligaya", "Nabuclod", "Pabanlag", "Paguiruan", "Palmayo", "Pandaguirig", "Poblacion", "San Antonio", "San Isidro", "San Jose", "San Nicolas", "San Pedro", "San Ramon", "San Roque", "Sta Monica", "Solib", "Valdez", "Mawacat"],
        postal_code: "2006"
    },
    "Guagua": {
        barangays: ["Bancal", "Jose Abad Santos", "Lambac", "Magsaysay", "Maquiapo", "Natividad", "Plaza Burgos", "Pulungmasle", "Rizal", "San Agustin", "San Antonio", "San Isidro", "San Jose", "San Juan Bautista", "San Juan Nepomuceno", "San Matias", "San Miguel", "San Nicolas 1st", "San Nicolas 2nd", "San Pablo", "San Pedro", "San Rafael", "San Roque", "San Vicente", "San Juan", "Santa Filomena", "Santa Ines", "Santa Ursula", "Santo Cristo", "Santo Nino", "Ascomo"],
        postal_code: "2003"
    },
    "Lubao": {
        barangays: ["Balantacan", "Bancal Sinubli", "Bancal Pugad", "Baruya", "Calangain", "Concepcion", "Del Carmen", "De La Paz", "Don Ignacio Dimson", "Lourdes", "Prado Siongco", "Remedios", "San Agustin", "San Antonio", "San Francisco", "San Isidro", "San Jose Apunan", "San Jose Gumi", "San Juan", "San Matias", "San Miguel", "San Nicolas 1st", "San Nicolas 2nd", "San Pablo 1st", "San Pablo 2nd", "San Pedro Palcarangan", "San Pedro Palcarangan", "San Pedro Saug", "San Roque Arbol", "San Roque Dau", "San Vicente", "Santa Barbara", "Santa Catalina", "Santa Cruz", "Santa Lucia", "Santa Maria", "Santa Monica", "Santa Rica", "Santa Teresa 1st", "Santa Teresa 2nd", "Santiago", "Santo Domingo", "Santo Nino", "Santo Tomas", "Santo Cristo"],
        postal_code: "2005"
    },
    "Mabalacat City": {
        barangays: ["Atlu-Bola", "Bical", "Bundagul", "Cacutud", "Calumpang", "Camachiles", "Dapdap", "Dau", "Dolores", "Duquit", "Lakandula", "Mabiga", "Macapagal Village", "Mamatitang", "Mangalit", "Marcos Village", "Mawaque", "Paralayunan", "Poblacion", "San Francisco", "San Joaquin", "Santa Ines", "Santa Maria", "Santo Rosario", "Sapang Balen", "Sapang Biabas", "Tabun"],
        postal_code: "2010"
    },
    "Macabebe": {
        barangays: ["Batasan", "Caduang Tete", "Candelaria", "Castuli", "Consuelo", "Dalayap", "Mataguiti", "San Esteban", "San Francisco", "San Gabriel", "San Isidro", "San Jose", "San Juan", "San Rafael", "San Roque", "San Vicente", "Sta Cruz", "Sta Lutgarda", "Sta Maria", "Sta Rita", "Sto Nino", "Sto Rosario", "Saplad David", "Tacasan", "Telacsan"],
        postal_code: "2017"
    },
    "Magalang": {
        barangays: ["Camias", "Dolores", "Escaler", "La Paz", "Navaling", "San Agustin", "San Antonio", "San Francisco", "San Ildefonso", "San Isidro", "San Jose", "San Miguel", "San Nicolas 1st", "San Nicolas 2nd", "San Pablo", "San Pedro I", "San Pedro II", "San Roque", "San Vicente", "Santa Cruz", "Santa Lucia", "Santa Maria", "Santo Nino", "Santo Rosario", "Bucunan", "Turu Ayala"],
        postal_code: "2011"
    },
    "Masantol": {
        barangays: ["Alauli", "Bagang", "Balibago", "Bebe Anac", "Bebe Matua", "Bulacus", "San Agustin", "Sta Monica", "Cambasi", "Malauli", "Nigui", "Palimpe", "Puti", "Sagrada", "San Isidro Anac", "San Isidro Matua", "San Nicolas", "San Pedro", "Sta Cruz", "Sta Lucia Matua", "Sta Lucia Paguiba", "Sta Lucia Wakas", "Sta Lucia Anac", "Sapang Kawayan", "Sua", "Sto Nino"],
        postal_code: "2017"
    },
    "Mexico": {
        barangays: ["Acli", "Anao", "Balas", "Buenavista", "Camuning", "Cawayan", "Concepcion", "Culubasa", "Divisoria", "Dolores", "Eden", "Gandus", "Lagundi", "Laput", "Laug", "Masamat", "Masangsang", "Nueva Victoria", "Pandacaqui", "Pangatlan", "Panipuan", "Parian", "Sabanilla", "San Antonio", "San Carlos", "San Jose Malino", "San Jose Matulid", "San Juan", "San Lorenzo", "San Miguel", "San Nicolas", "San Pablo", "San Patricio", "San Rafael", "San Roque", "San Vicente", "Santa Cruz", "Santa Maria", "Santo Domingo", "Santo Rosario", "Sapang Maisac", "Suclaban", "Tangle"],
        postal_code: "2021"
    },
    "Minalin": {
        barangays: ["Bulac", "Dawe", "Lourdes", "Maniango", "San Francisco 1st", "San Francisco 2nd", "San Isidro", "San Nicolas", "San Pedro", "Sta Catalina", "Sta Maria", "Sta Rita", "Sto Domingo", "Sto Rosario", "Saplad"],
        postal_code: "2019"
    },
    "Porac": {
        barangays: ["Babo Pangulo", "Babo Sacan", "Balubad", "Calzadang Bayu", "Camias", "Cangatba", "Diaz", "Dolores", "Jalung", "Mancatian", "Manibaug Libutad", "Manibaug Paralaya", "Manibaug Pasig", "Manuali", "Mitia Proper", "Palat", "Pias", "Pio Planas", "Poblacion", "Pulung Santol", "Salu", "San Jose Mitla", "Sta Cruz", "Sepung Bulaon", "Sinura", "Villa Maria", "Inararo", "Sapang Uwak"],
        postal_code: "2008"
    },
    "San Fernando City": {
        barangays: ["Alasas", "Baliti", "Bulaon", "Calulut", "Dela Paz Norte", "Dela Paz Sur", "Del Carmen", "Del Rosario", "Dolores", "Julian", "Lara", "Lourdes", "Magliman", "Maimpis", "Malino", "Malpitic", "Pandaras", "Panipuan", "Santo Rosario", "Quebiauan", "Saguin", "San Agustin", "San Felipe", "San Isidro", "San Jose", "San Juan", "San Nicolas", "San Pedro", "Santa Lucia", "Santa Teresita", "Santo Nino", "Sindalan", "Telabastagan", "Pulung Bulu"],
        postal_code: "2000"
    },
    "San Luis": {
        barangays: ["San Agustin", "San Carlos", "San Isidro", "San Jose", "San Juan", "San Nicolas", "San Roque", "San Sebastian", "Santa Catalina", "Santa Cruz Pambilog", "Santa Cruz Poblacion", "Santa Lucia", "Santa Monica", "Santa Rita", "Santo Nino", "Santo Rosario", "Santo Tomas"],
        postal_code: "2004"
    },
    "San Simon": {
        barangays: ["Concepcion", "De La Paz", "San Juan", "San Agustin", "San Isidro", "San Jose", "San Miguel", "San Nicolas", "San Pablo Libutad", "San Pablo Proper", "San Pedro", "Santa Cruz", "Santa Monica", "Santo Nino"],
        postal_code: "2010"
    },
    "Santa Ana": {
        barangays: ["San Agustin", "San Bartolome", "San Isidro", "San Joaquin", "San Jose", "San Juan", "San Nicolas", "San Pablo", "San Pedro", "San Roque", "Santa Lucia", "Santa Maria", "Santiago", "Santo Rosario"],
        postal_code: "2009"
    },
    "Santa Rita": {
        barangays: ["Becuran", "Dila-Dila", "San Agustin", "San Basilio", "San Isidro", "San Jose", "San Juan", "San Matias", "San Vicente", "Santa Monica"],
        postal_code: "2005"
    },
    "Santo Tomas": {
        barangays: ["Moras De La Paz", "Poblacion", "San Bartolome", "San Matias", "San Vicente", "Santo Rosario", "Sapa"],
        postal_code: "2020"
    },

    "Sasmuan": {
        barangays: ["Batang 1st", "Batang 2nd", "Mabuanbuan", "Malusac", "Sta Lucia", "San Antonio", "San Nicolas 1st", "San Nicolas 2nd", "San Pedro", "Santa Monica"],
        postal_code: "2004"
    },
  }
    
};

function populateCities() {
    const province = document.getElementById('province').value;
    const cities = addresses[province];
    const citySelect = document.getElementById('cityMunicipality');
    
    // Clear existing options
    citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
    
    // Populate with new options
    for (const city in cities) {
        const option = document.createElement('option');
        option.value = city;
        option.text = city;
        citySelect.appendChild(option);
    }
}

function populateBarangays() {
    const province = document.getElementById('province').value;
    const city = document.getElementById('cityMunicipality').value;
    const barangays = addresses[province][city].barangays;
    const barangaySelect = document.getElementById('barangay');
    
    // Clear existing options
    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
    
    // Populate with new options
    barangays.forEach(barangay => {
        const option = document.createElement('option');
        option.value = barangay;
        option.text = barangay;
        barangaySelect.appendChild(option);
    });
    
    // Set the postal code
    const postalCode = addresses[province][city].postal_code;
    document.getElementById('postalCode').value = postalCode;
}




    </script>
    
</html>