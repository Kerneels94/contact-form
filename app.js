// Dom elements
const submit = document.querySelector('[data-key="submit"]');

// Front end validation
const fname = document.myForm.fname.value;
const sname = document.myForm.sname.value;
const emailID = document.myForm.email.value;
const password = document.myForm.password.value;
const cpassword = document.myForm.cpassword.value;

// Functions
const validate = () => {
  fname == null || fname == "" ? alert("Please enter first name") : false;
  sname == null || sname == "" ? alert("Please enter surname") : false;
  password == null || password == "" ? alert("Please enter password") : false;
  validateEmail();
  checkPassword();
};

const checkPassword = () => {
  if (password == cpassword) {
    return true;
  } else if (password.length < 6) {
    alert("password should be 6 characters");
    return false;
  }
};

const validateEmail = () => {
  console.log(emailID);
  atpos = emailID.indexOf("@");
  dotpos = emailID.lastIndexOf(".");

  if (atpos < 1 || dotpos - atpos < 2) {
    alert("Please enter correct email ID");
    document.myForm.email.focus();
    return false;
  }
};

// EventListeners
submit.addEventListener("click", validate);
