function togglePassword(fieldId) {
  const field = document.getElementById(fieldId);
  if (field) {
    field.type = field.type === "password" ? "text" : "password";
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("applyForm");
  if (!form) return; // Exit if not on signup page

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    let valid = true;

    // First name
    const firstname = document.getElementById("firstname");
    if (firstname.value.trim() === "") {
      firstname.classList.add("is-invalid");
      valid = false;
    } else {
      firstname.classList.remove("is-invalid");
      firstname.classList.add("is-valid");
    }

    // Last name
    const lastname = document.getElementById("lastname");
    if (lastname.value.trim() === "") {
      lastname.classList.add("is-invalid");
      valid = false;
    } else {
      lastname.classList.remove("is-invalid");
      lastname.classList.add("is-valid");
    }

    // Email
    const email = document.getElementById("email");
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.value.match(emailPattern)) {
      email.classList.add("is-invalid");
      valid = false;
    } else {
      email.classList.remove("is-invalid");
      email.classList.add("is-valid");
    }

    // Phone
    const phone = document.getElementById("phone");
    const phonePattern = /^[0-9]{10,15}$/;
    if (!phone.value.match(phonePattern)) {
      phone.classList.add("is-invalid");
      valid = false;
    } else {
      phone.classList.remove("is-invalid");
      phone.classList.add("is-valid");
    }

    // Password
    const password = document.getElementById("password");
    if (password.value.length < 6) {
      password.classList.add("is-invalid");
      valid = false;
    } else {
      password.classList.remove("is-invalid");
      password.classList.add("is-valid");
    }

    // Confirm password
    const confirmPassword = document.getElementById("confirm_password");
    if (
      confirmPassword.value !== password.value ||
      confirmPassword.value === ""
    ) {
      confirmPassword.classList.add("is-invalid");
      valid = false;
    } else {
      confirmPassword.classList.remove("is-invalid");
      confirmPassword.classList.add("is-valid");
    }

    if (valid) {
      this.submit(); // Only submit if all validations pass
    }
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("loginForm");
  if (!form) return; // Exit if not on signup page

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    let valid = true;

    // Email
    const email = document.getElementById("email");
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.value.match(emailPattern)) {
      email.classList.add("is-invalid");
      valid = false;
    } else {
      email.classList.remove("is-invalid");
      email.classList.add("is-valid");
    }

    // Password
    const password = document.getElementById("password");
    if (password.value.length < 6) {
      password.classList.add("is-invalid");
      valid = false;
    } else {
      password.classList.remove("is-invalid");
      password.classList.add("is-valid");
    }

    if (valid) {
      this.submit(); // Only submit if all validations pass
    }
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("resendForm");
  if (!form) return; // Exit if not on signup page

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    let valid = true;
    // Email
    const email = document.getElementById("email");
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.value.match(emailPattern)) {
      email.classList.add("is-invalid");
      valid = false;
    } else {
      email.classList.remove("is-invalid");
      email.classList.add("is-valid");
    }
    if (valid) {
      this.submit(); // Only submit if all validations pass
    }
  });
});
