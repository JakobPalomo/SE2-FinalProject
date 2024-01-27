// Get the checkbox, register button, and modal elements
const checkbox = document.getElementById("checkbox-1");
const registerBtn = document.querySelector('input[name="register_btn"]');
const termsModal = new bootstrap.Modal(document.getElementById("termsModal"));

// Add event listener to the "Click to View" link to open the modal
document
  .querySelector('label[for="checkbox-1"] a')
  .addEventListener("click", function (e) {
    e.preventDefault(); // Prevent the default action of the link
    termsModal.show(); // Open the modal
  });

// Add event listener to the registration form
document.forms.registrationForm.addEventListener("submit", function (e) {
  if (!checkbox.checked) {
    e.preventDefault(); // Prevent form submission
    alert("Please agree to the terms and conditions by ticking the checkbox.");
  } else {
    // Checkbox is ticked, proceed with the form action
    // You can optionally submit the form programmatically here:
    // document.forms.registrationForm.submit();
  }
});
