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
