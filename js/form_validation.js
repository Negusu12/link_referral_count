function validateForm() {
  const firstName = document.getElementById("first_name").value.trim();
  const middleName = document.getElementById("middle_name").value.trim();
  const lastName = document.getElementById("last_name").value.trim();
  const phone = document.getElementById("phone").value.trim();
  const email = document.getElementById("email").value.trim();

  // Regex for phone number and email validation
  const phoneRegex = /^[0-9]{10}$/; // Validates a 10-digit phone number
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!firstName) {
    Swal.fire("Validation Error", "First name is required!", "error");
    return false;
  }

  if (!middleName) {
    Swal.fire("Validation Error", "Middle name is required!", "error");
    return false;
  }

  if (!lastName) {
    Swal.fire("Validation Error", "Last name is required!", "error");
    return false;
  }

  if (!phone) {
    Swal.fire("Validation Error", "Phone number is required!", "error");
    return false;
  }

  if (!phoneRegex.test(phone)) {
    Swal.fire(
      "Validation Error",
      "Please enter a valid 10-digit phone number!",
      "error"
    );
    return false;
  }

  if (!email) {
    Swal.fire("Validation Error", "Email is required!", "error");
    return false;
  }

  if (!emailRegex.test(email)) {
    Swal.fire(
      "Validation Error",
      "Please enter a valid email address!",
      "error"
    );
    return false;
  }

  // If all validations pass
  Swal.fire("Success", "Form submitted successfully!", "success");
  return true;
}
