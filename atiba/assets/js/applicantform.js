document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("biodataForm");
  const dobField = document.getElementById("dob");

  // Only run this script if biodataForm and dobField exist
  if (form && dobField) {

    // 🔹 Set max date to today - 14 years
    const today = new Date();
    const minDob = new Date(today.getFullYear() - 14, today.getMonth(), today.getDate());
    dobField.setAttribute("max", minDob.toISOString().split("T")[0]);

    form.addEventListener("submit", function (event) {
      event.preventDefault(); // Stop form from submitting until validation passes

      // Collect fields
      const fields = {
        firstname: document.getElementById("firstname"),
        lastname: document.getElementById("lastname"),
        gender: document.getElementById("gender"),
        dob: dobField,
        religion: document.getElementById("religion"),
        marital_status: document.getElementById("marital_status"),
        hometown: document.getElementById("hometown"),
        nationality: document.getElementById("nationality"),
        state_origin: document.getElementById("state_origin"),
      };

      // Check for empty values
      for (const key in fields) {
        if (fields[key].value.trim() === "") {
          alert(`Please fill in your ${key.replace("_", " ")}.`);
          fields[key].focus();
          return false;
        }
      }

      // Extra check: Date of birth not in the future
      const enteredDate = new Date(fields.dob.value);
      if (enteredDate > today) {
        alert("Date of birth cannot be in the future.");
        fields.dob.focus();
        return false;
      }

      // Extra check: Must be at least 14 years old
      const minAge = 14;
      const ageDiff = today.getFullYear() - enteredDate.getFullYear();
      const hasBirthdayPassed =
        today.getMonth() > enteredDate.getMonth() ||
        (today.getMonth() === enteredDate.getMonth() &&
          today.getDate() >= enteredDate.getDate());

      const age = hasBirthdayPassed ? ageDiff : ageDiff - 1;

      if (age < minAge) {
        alert("You must be at least 14 years old to register.");
        fields.dob.focus();
        return false;
      }

      // ✅ All checks passed
      form.submit();
    });
  }
});
