var verifyEmail = document.getElementById("verify_email");
var email = document.getElementById("email");
var password = document.getElementById("pswd");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");
var confirmPass = document.getElementById("confirm_pswd");

// When the user starts to type something inside the password field
password.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(password.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(password.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(password.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(password.value.length >= 7) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }

  // Validate length Confirm password
  if(confirmPass.value == password.value) {
    matchPass.classList.remove("invalid");
    matchPass.classList.add("valid");
  } else {
    matchPass.classList.remove("valid");
    matchPass.classList.add("invalid");
  }

  // Validate length Confirm password & Email
  if((confirmPass.value == password.value) && (verifyEmail.value == email.value)) {
    document.getElementById("btnSubmit").disabled = false;
  } else {
    document.getElementById("btnSubmit").disabled = true;
  }

  if((confirmPass.value == password.value)) {
    document.getElementById("btnResetPass").disabled = false;
  } else {
    document.getElementById("btnResetPass").disabled = true;
  }
}
// Validate length Confirm password
confirmPass.onkeyup = function() {
  // Validate length Confirm password
  if(confirmPass.value == password.value) {
    matchPass.classList.remove("invalid");
    matchPass.classList.add("valid");
  } else {
    matchPass.classList.remove("valid");
    matchPass.classList.add("invalid");
  }

  // Validate length Confirm password & Email
  if((confirmPass.value == password.value) && (verifyEmail.value == email.value)) {
    document.getElementById("btnSubmit").disabled = false;
  } else {
    document.getElementById("btnSubmit").disabled = true;
  }

  if((confirmPass.value == password.value)) {
    document.getElementById("btnResetPass").disabled = false;
  } else {
    document.getElementById("btnResetPass").disabled = true;
  }
}

// Validate length Confirm Email
verifyEmail.onkeyup = function() {
  if(verifyEmail.value == email.value) {
    matchEmail.classList.remove("invalid");
    matchEmail.classList.add("valid");
  } else {
    matchEmail.classList.remove("valid");
    matchEmail.classList.add("invalid");
  }

  // Validate length Confirm password & Email
  if((confirmPass.value == password.value) && (verifyEmail.value == email.value)) {
    document.getElementById("btnSubmit").disabled = false;
  } else {
    document.getElementById("btnSubmit").disabled = true;
  }
}

// Validate length Confirm Email
email.onkeyup = function() {
  if(verifyEmail.value == email.value) {
    matchEmail.classList.remove("invalid");
    matchEmail.classList.add("valid");
  } else {
    matchEmail.classList.remove("valid");
    matchEmail.classList.add("invalid");
  }

  // Validate length Confirm password & Email
  if((confirmPass.value == password.value) && (verifyEmail.value == email.value)) {
    document.getElementById("btnSubmit").disabled = false;
  } else {
    document.getElementById("btnSubmit").disabled = true;
  }
}