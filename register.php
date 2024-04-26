<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/navbar.css" />
    <link rel="stylesheet" type="text/css" href="css/menuelement.css" />
    <link rel="stylesheet" type="text/css" href="./css/faqs.css" />
    <link rel="stylesheet" type="text/css" href="css/register.css" />
    <title>Register</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="shortcut icon" type="x-icon" href="./img/logomini.png">
    <link href="https://fonts.googleapis.com/css2?family=Inika&family=Plus+Jakarta+Sans&display=swap" rel="stylesheet">
</head>
<body style="background-color: #f5f5dc" class="apply-padding">
    <?php include('common/navbar.php');?>
    <div class="container">
        <div class="box form-box">
            <?php
                if(isset($_SESSION['status']))
                {
                    echo '<div class="alert">';
                    echo "<h4>" .$_SESSION['status']. "</h4>";
                    unset($_SESSION['status']); 
                    echo '</div>';
                }
            ?>

            <header>Create your Account</header>
            <form name="registrationForm" action="./function/register-function.php" method="POST" onsubmit="return validateForm()">
                <div class="field input">
                    <label for="FirstName">First Name</label>
                    <input type="text" name="fname" required>
                </div>

                <div class="field input">
                    <label for="LastName">Last Name</label>
                    <input type="text" name="lname" required>
                </div>

                <div class="field input">
                    <label for="Email">Email</label>
                    <input type="text" name="email" required>
                </div>

                <div class="field input">
                    <label for="ContactNumber">Contact Number</label>
                    <input type="text" name="contact" required>
                </div>

                <!-- Separate address inputs -->
                <div class="field input">
                    <label for="Province">Province</label>
                    <select class ="form-select" id="province" name="province" required>
                        <option selected disabled>Select Province</option>
                        <option value="Pampanga">Pampanga</option>
                    </select>
                </div>

                <div class="field input">
                    <label for="City">City/Municipality</label>
                    <select class ="form-select" id="city" name="city" required>
                        <option selected disabled>Select City/Municipality</option>
                    </select>
                </div>

                <div class="field input">
                    <label for="BuildingNumber">Building/House Number</label>
                    <input type="text" name="building_number" maxlength="60" required>
                </div>

                <div class="field input">
                    <label for="Street">Street</label>
                    <input type="text" name="street" maxlength="60" required>
                </div>

                <div class="field input">
                <label for="Barangay">Barangay</label>
              <select class ="form-select" id="barangay" name="barangay" required>
              <option selected disabled>Select Barangay</option>
              </select>
            </div>

                

            <div class="field input">
    <label for="PostalCode">Postal Code</label>
    <input type="text" id="postal_code" name="postal_code" pattern="\d*" maxlength="60" readonly required>
</div>

                <div class="field input">
                    <label for="Password">Password</label>
                    <input type="password" name="password" required>
                </div>

                <div class="field input">
                    <label for="ConfirmPassword">Confirm Password</label>
                    <input type="password" name="confirm_password" required>
                </div>

                <input type="checkbox" id="checkbox-1" name="checkbox-1" value="1">
                <label for="checkbox-1">I agree to the terms and conditions.<a class="hyperlink" href=""> Click to View</a></label>

                <div class="field">
                    <input type="submit" class="button" name="register_btn" value="Register" required>
                </div>

                <div class="links">
                    Have an Account?<a class="hyperlink" href="login.php"> Login</a>
                </div>

            </form>
        </div>
    </div>

    <script>
        const addresses = {
          "Pampanga": {
    "Angeles City": {
        barangays: ["Anunas", "Balibago", "Capaya", "Claro M. Recto", "Cuayan", "Cutcut", "Lourdes North West (Talimundok)", "Lourdes Sur (Talimundok)", "Malabanias", "Margot", "Marisol", "Mining", "Pulung Cacutud", "Pulung Maragul", "Pulong Masle", "Sapalibutad", "Sapangbato", "Sto. Cristo", "Sto. Domingo (Pob.)", "Sto. Rosario (Pob.)", "Santo Rosario (Pob.)", "Salapungan", "Santa Teresita", "Santo Niño", "Santo Rosario (Pob.)", "Virgen Delos Remedios"],
        postal_code: "2009"
    },
    "Apalit": {
        barangays: ["Balucuc", "Capalangan", "Carmen", "Colgante", "Culantung", "Paligui", "Pampanga Day", "Sampaloc", "San Juan", "Sulipan"],
        postal_code: "2016"
    },
    "Arayat": {
        barangays: ["Bisal", "Cupang", "Gatiawin", "Gatiawin", "Lacmit", "Lanat", "Mabatang", "Matamo", "Pio", "Santo Rosario", "Tabuan", "Villa Maria"],
        postal_code: "2012"
    },
    "Bacolor": {
        barangays: ["Cabambangan", "Cabetican", "Concepcion", "Dolores", "Macabacle", "Magliman", "Magsaysay", "Malauli", "Parulog", "San Antonio", "San Isidro", "San Vicente", "Santa Barbara (Pob.)", "Santa Ines (Pob.)", "Santa Lucia", "Santa Maria", "Santa Cruz (Pob.)", "Santo Niño", "Villa Maria (Pob.)"],
        postal_code: "2001"
    },
    "Candaba": {
        barangays: ["Bahay Pare", "Bambang", "Barit", "Buas", "Cacutud", "Dulong Ilog", "Mangga", "Meyto", "Pansinao", "Pulong Gubat", "Pulong Palazan", "San Agustin", "San Antonio", "San Isidro", "San Jose", "San Juan", "San Pablo", "San Pedro", "Santa Cruz", "Santa Lucia", "Santa Rita", "Santo Rosario (Pob.)", "Sapang Kawayan", "Sulipan", "Tenejero", "Vizal San Pablo"],
        postal_code: "2013"
    },
    "Floridablanca": {
        barangays: ["Anon", "Apalit", "Bancal", "Calantas", "Mabical", "Mabiga", "Malabo", "Maligaya", "Mamatitang", "Mapalad", "Pabanlag", "Pampang", "Poblacion", "San Antonio", "San Isidro", "San Jose", "San Juan", "San Nicolas", "San Pedro", "Santa Monica", "Santo Niño", "Sapang Balen", "Sapang Uwak", "Solib", "Villa Maria"],
        postal_code: "2006"
    },
    "Guagua": {
        barangays: ["Bancal", "Betis", "Caliligawan", "Concepcion", "Dela Cruz", "Lambac", "Lourdes", "Magsaysay", "Manibaug", "Maniango", "Natividad", "Pamintuan", "Parulog", "Poblacion", "San Agustin", "San Antonio", "San Isidro", "San Jose", "San Matias", "San Pedro", "San Roque", "San Vicente", "Santa Filomena", "Santa Ines", "Santa Ursula", "Santo Cristo", "Santo Niño", "Santo Rosario"],
        postal_code: "2003"
    },
    "Lubao": {
        barangays: ["Aguso", "Apalit", "Baruya", "Concepcion", "Lourdes", "Prado Saba", "Prado Ray", "San Francisco", "San Isidro", "San Jose Gumi", "San Matias", "San Miguel", "San Nicolas 1st", "San Nicolas 2nd", "San Pablo 1st", "San Pablo 2nd", "San Pedro Palcarangan", "Santa Barbara", "Santa Catalina", "Santa Cruz", "Santa Lucia", "Santa Monica", "Santa Rita", "Santa Teresa", "Santo Tomas", "Santo Niño", "Santo Rosario", "Tangle", "Tinang"],
        postal_code: "2005"
    },
    "Mabalacat City": {
        barangays: ["Atlu-Bola", "Bical", "Bundagul", "Cacutud", "Calumpang", "Camachiles", "Dapdap", "Dau", "Dolores", "Duquit", "Lourdes", "Mabiga", "Macapagal Village", "Mamatitang", "Manuel A. Roxas", "Marimla", "Mawaque", "Mazapil", "Mazubi", "Nabuclod", "Pandacaqui", "Paralayunan", "Poblacion", "Sagrada Familia", "Santa Ines", "Santa Maria", "Santo Rosario", "Sapalibutad", "Sapang Balen", "Sapang Biabas", "Sapang Maisac", "Tabun", "Talaga", "Tanguayu", "Turon", "Sapang Bato"],
        postal_code: "2010"
    },
    "Macabebe": {
        barangays: ["Batasan", "Buenavista", "Calantas", "Dolores", "Lumandol", "Macabebe", "Magaul Birdge", "Maligaya", "Mataguiti", "Pangatlan", "San Jose Matulid", "San Juan", "San Nicolas", "San Vicente", "Santa Maria", "Santo Rosario", "Tagulod", "Tumana"],
        postal_code: "2017"
    },
    "Magalang": {
        barangays: ["Balitucan", "Bodega", "San Agustin", "San Antonio", "San Bartolome", "San Francisco", "San Isidro", "San Jose", "San Juan", "San Miguel", "San Nicolas", "San Pablo", "San Pedro", "San Roque", "Santa Lucia", "Santa Maria", "Santa Teresita", "Santo Rosario", "Sapang Balen"],
        postal_code: "2011"
    },
    "Masantol": {
        barangays: ["Buenavista", "Camias", "Dalayap", "Dolores", "Lanat", "Lapnit", "Balibago", "Linga", "Mabuanbuan", "Maite", "Paligui", "San Agustin", "San Nicolas", "Santa Lucia", "Santo Rosario", "Saplad David", "Saplad Kahoy", "Saplad Tapa", "Sula", "Poblacion"],
        postal_code: "2017"
    },
    "Mexico": {
        barangays: ["Balacat", "Camuning", "Calumpang", "Lourdes", "Mancatian", "Masamat", "Pandacaqui", "Panipuan", "Parian", "San Antonio", "San Jose Matulid", "San Juan", "Santa Cruz", "Santa Cruz Pambilog", "Santa Maria", "Santa Monica", "Santo Rosario", "Santo Tomas", "Sapang Maisac", "Saplad Dau", "Saplad Kati", "Saplad Pandan", "Sula", "Poblacion"],
        postal_code: "2021"
    },
    "Minalin": {
        barangays: ["Batasan", "Bical", "Cabusacan", "Dolores", "San Francisco", "San Isidro", "San Nicolas", "Santa Clara", "Santa Maria", "Santo Domingo", "Santo Rosario", "Santo Tomas"],
        postal_code: "2019"
    },
    "Porac": {
        barangays: ["Cangatba", "Diaz", "Dolores", "Inararo", "Mancatian", "Manibaug Paralaya", "Manibaug Pasig", "Manuel B. Villar, Sr.", "Pabanlag", "Pias", "Pio", "Planas", "Poblacion", "Pulung Santol", "Sagrada", "Salu", "Santa Cruz", "Santa Maria", "Santo Domingo", "Santo Rosario", "Sapang Uwak", "Sepung Bulaun", "Villa Maria"],
        postal_code: "2008"
    },
    "San Fernando City": {
        barangays: ["Agustin P. Tambungui", "Almacen", "Bulaon", "Calulut", "Dela Paz Norte", "Dela Paz Sur", "Del Carmen", "Del Pilar", "Dolores", "Juliana", "Lara", "Lourdes", "Maimpis", "Malino", "Magliman", "Magliman Dike", "Malpitic", "Panipuan", "Pulungbulu", "Quebiawan", "Saguin", "San Agustin", "San Felipe", "San Isidro", "San Jose", "San Juan", "San Nicolas", "Santa Lucia", "Santa Teresita", "Santo Niño", "Santo Rosario", "Sindalan", "Telabastagan"],
        postal_code: "2000"
    },
    "San Luis": {
        barangays: ["Balutu", "Bancal Pugad", "Bancal Sinubli", "Cawayan", "Diaz", "Dolores", "Lubao Poblacion", "Mangga", "Parang", "Paudpod", "San Agustin", "San Isidro", "San Jose", "San Juan", "San Matias", "San Miguel", "San Nicolas", "San Pablo", "Santa Cruz", "Santa Monica", "Santa Rita", "Santa Teresita", "Santo Niño", "Santo Rosario", "Sapang", "Sapa", "Sapang Balen", "Sapang Kawayan", "Sapang Maisac", "Sapang Maragul", "Sapang Putik", "Tinajero"],
        postal_code: "2004"
    },
    "San Simon": {
        barangays: ["Bano", "Bicutan", "Bundagul", "Candating", "Lanang", "Laug", "Mangga", "Pitabunan", "San Agustin", "San Francisco", "San Isidro", "San Juan", "San Nicolas", "San Pablo", "Santa Cruz", "Santa Monica", "Santa Rita", "Santo Niño", "Santo Rosario", "Sapa Grande"],
        postal_code: "2010"
    },
    "Santa Ana": {
        barangays: ["Calmayo", "Candelaria", "Dancalan", "Del Carmen", "Lourdes", "Poblacion", "San Agustin", "San Bartolome", "San Isidro", "San Joaquin", "San Jose", "San Juan", "San Nicolas", "San Pablo", "Santa Lucia", "Santa Maria", "Santa Rita", "Santo Rosario", "Santo Tomas", "Sulipan", "Telacsan", "Tibagan"],
        postal_code: "2009"
    },
    "Santa Rita": {
        barangays: ["Bancal Sinubli", "Bancal Pugad", "Buenavista", "Cabanatuan", "Cacutud", "Calulut", "Dila-Dila", "Dolores", "Dulong Bayan", "Ireneville I", "Ireneville II", "Malusac", "Palangue", "Pandan", "Pau", "Poblacion", "San Agustin", "San Basilio", "San Isidro", "San Jose", "San Juan", "San Matias", "San Miguel", "San Nicolas", "San Pablo", "San Pedro", "Santa Catalina", "Santa Cruz", "Santa Lucia", "Santa Monica", "Santa Rita", "Santa Teresita", "Santo Domingo", "Santo Niño", "Sapang Balen", "Sapang Maragul", "Sapang Putik", "Sapang Uwak", "Sua", "Suclayin", "Tua"],
        postal_code: "2005"
    },
    "Santo Tomas": {
        barangays: ["Baguindoc", "Balutu", "Bancal", "Burgos", "Cruz", "De La Paz", "Dela Cruz", "Dela Paz Norte", "Dela Paz Sur", "La Loma", "Lomboy", "Maimpis", "Mangga", "Matasim", "Natividad", "Pampaunlad", "Pandaras", "Panipuan", "Poblacion", "San Agustin", "San Bartolome", "San Felipe", "San Isidro", "San Joaquin", "San Jose", "San Juan", "San Matias", "San Nicolas", "San Pablo", "San Pedro", "San Rafael", "San Roque", "San Vicente", "Santa Cruz", "Santa Lucia", "Santa Maria", "Santa Monica", "Santa Rita", "Santa Rosa", "Santo Domingo", "Santo Niño", "Santo Rosario", "Sapang Balen", "Sapang Maragul", "Sapang Putik", "Sapang Uwak", "Talimundoc", "Tenejero", "Tibag", "Tucop", "Villa Maria"],
        postal_code: "2020"
    },
  }S
    
};

const provinceSelect = document.getElementById('province');
const citySelect = document.getElementById('city');
const barangaySelect = document.getElementById('barangay');
const postalCodeInput = document.getElementById('postal_code');

provinceSelect.addEventListener('change', () => {
    const selectedProvince = provinceSelect.value;
    if (selectedProvince === 'Pampanga') {
        citySelect.innerHTML = '<option selected disabled>Select City/Municipality</option>';
        barangaySelect.innerHTML = '<option selected disabled>Select Barangay</option>';
        postalCodeInput.value = '';

        Object.keys(addresses[selectedProvince]).forEach(city => {
            const option = document.createElement('option');
            option.value = city;
            option.text = city;
            citySelect.appendChild(option);
        });
    } else {
        citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
        postalCodeInput.value = '';
    }
});

citySelect.addEventListener('change', () => {
    const selectedProvince = provinceSelect.value;
    const selectedCity = citySelect.value;
    if (selectedProvince === 'Pampanga' || selectedProvince === 'Quezon') {
        barangaySelect.innerHTML = '<option selected disabled>Select Barangay</option>';
        postalCodeInput.value = addresses[selectedProvince][selectedCity].postal_code;

        addresses[selectedProvince][selectedCity].barangays.forEach(barangay => {
            const option = document.createElement('option');
            option.value = barangay;
            option.text = barangay;
            barangaySelect.appendChild(option);
        });
    } else {
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
        postalCodeInput.value = '';
    }
});

barangaySelect.addEventListener('change', () => {
    const selectedProvince = provinceSelect.value;
    const selectedCity = citySelect.value;
    const selectedBarangay = barangaySelect.value;
    if (selectedProvince === 'Pampanga' || selectedProvince === 'Quezon') {
        postalCodeInput.value = addresses[selectedProvince][selectedCity].postal_code;
    } else {
        postalCodeInput.value = '';
    }
});

    </script>
    <!-- End Code -->
    <!-- Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <p>Chef's Daughter Terms and Conditions<br/><br/>

1. Order Confirmation
<br/>
Once orders are confirmed, any changes shall no longer be allowed.
<br/>
<br/>
2. Online Order Period
<br/>
Online Pending orders will remain active for a maximum of 3 days. GCash payments must be settled within 3 days; otherwise, they will be automatically declined.
<br/>
<br/>
3. Food Tray Delivery
<br/>
Once food trays are delivered, it is best advised that food trays must be opened to prevent spoilage.
<br/>
<br/>
4. Storage of Food Trays
<br/>
Food trays that are not consumed or served an hour after delivery time shall be stored in a cool temperature or area.
<br/>
<br/>
5. Allergies and Special Requests
<br/>
Inform Chef’s Daughter regarding personal food allergies, if any.
<br/>
<br/>
Special requests (e.g., chicken part request, no use of MSG, no pepper, etc.) must be discussed upon ordering.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/register.js"></script>
    <script src="./js/termsandcondition.js"></script>
    <footer class="footer">
        <br>
        <h3>Contact us through</h3><br>
        <p><i class="fa-brands fa-facebook" style="color: #f5f5f5; font-size:26px;"></i>&nbsp;&nbsp; <a href="https://www.facebook.com/chefsdaughterph" target="_blank"  style="color: inherit; text-decoration: none;">chefsdaughter</a></p>
        <p><i class="fa-solid fa-phone" style="color: #f5f5f5; font-size:26px;"></i>&nbsp;&nbsp; 0915 121 7129</p>
        <p><i class="fa-solid fa-envelope" style="color: #f5f5f5; font-size:26px;"></i>&nbsp;&nbsp; chefsdaughterph@gmail.com</p>
        <br>
        <p style="opacity: .6;">2024 Chef's Daughter. All rights reserved.</p>
    </footer>
</body>
</html>
