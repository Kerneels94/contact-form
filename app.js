// Dom elements
const submit = document.getElementById("submitBtn");
const fname = document.myForm.fname.value;
const sname = document.myForm.sname.value;
const emailID = document.myForm.email.value;
const password = document.myForm.password.value;
const cpassword = document.myForm.cpassword.value;

// Functions
function validate() {
  fname == null || fname == "" ? alert("Please enter first name") : false;
  sname == null || sname == "" ? alert("Please enter surname") : false;
  validateEmail();
  checkPassword();
}
// Check password
function checkPassword() {
  //  If the check evaluates to true => update innerHTMl
  if (password.length < 8) {
    password.innerHTML = "Password should be longer than 8 Characters";
  }
  // If the confirm password is not equel to the password => update innerHTML
  if (cpassword !== password) {
    password.innerHTML = "Passwords do not match";
  }
}

function validateEmail() {
  atpos = emailID.indexOf("@");
  dotpos = emailID.lastIndexOf(".");

  if (atpos < 1 || dotpos - atpos < 2) {
    alert("Please enter correct email ID");
    document.myForm.email.focus();
    return false;
  }
}

// EventListeners
submit.addEventListener("click", validate);
