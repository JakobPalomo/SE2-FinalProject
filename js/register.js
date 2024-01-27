function validateForm() {
  var fname = document.forms["registrationForm"]["fname"].value;
  var lname = document.forms["registrationForm"]["lname"].value;
  var email = document.forms["registrationForm"]["email"].value;
  var contact = document.forms["registrationForm"]["contact"].value;
  var building_number =
    document.forms["registrationForm"]["building_number"].value;
  var street = document.forms["registrationForm"]["street"].value;
  var barangay = document.forms["registrationForm"]["barangay"].value;
  var city = document.forms["registrationForm"]["city"].value;
  var province = document.forms["registrationForm"]["province"].value;
  var postal_code = document.forms["registrationForm"]["postal_code"].value;
  var password = document.forms["registrationForm"]["password"].value;
  var confirm_password =
    document.forms["registrationForm"]["confirm_password"].value;

  // Validate First Name
  if (fname === "" || fname.length > 60) {
    alert(
      "First name should not be empty and should be less than or equal to 60 characters."
    );
    return false;
  }

  // Validate Last Name
  if (lname === "" || lname.length > 60) {
    alert(
      "Last name should not be empty and should be less than or equal to 60 characters."
    );
    return false;
  }

  // Validate Email
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    alert("Please enter a valid email address.");
    return false;
  }

  // Validate Contact Number
  var contactRegex = /^(09|\+639)\d{9}$/;
  if (!contactRegex.test(contact)) {
    alert(
      "Please enter a valid Filipino contact number (e.g., 09177902457 or +639177902457)."
    );
    return false;
  }

  var addressInputs = [
    building_number,
    street,
    barangay,
    city,
    province,
    postal_code,
  ];
  for (var i = 0; i < addressInputs.length; i++) {
    if (addressInputs[i] === "" || addressInputs[i].length > 60) {
      alert(
        "Address input should not be empty and should be less than or equal to 60 characters."
      );
      return false;
    }
  }
  var postalCode = document.forms["registrationForm"]["postal_code"].value;
  if (!/^\d*$/.test(postalCode)) {
    alert("Postal Code should contain only numeric values.");
    return false;
  }

  // Validate Password Strength
  var passwordStrengthRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/;
  if (!passwordStrengthRegex.test(password)) {
    alert(
      "Password should contain at least 8 characters, including one uppercase letter, one lowercase letter, and one digit."
    );
    return false;
  }

  // Validate Confirm Password
  if (password !== confirm_password) {
    alert("Passwords do not match.");
    return false;
  }

  return true;
}
