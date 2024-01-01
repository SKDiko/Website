function isRequired() {
  document.getElementById("medication").required = true;
  document.getElementById("quantity").required = true;
  document.getElementById("repeats").required = true;
  document.getElementById("instructions").required = true;
  document.getElementById("prescription_date").required = true;
}

function notRequired() {
  document.getElementById("medication").required = false;
  document.getElementById("quantity").required = false;
  document.getElementById("repeats").required = false;
  document.getElementById("instructions").required = false;
  document.getElementById("prescription_date").required = false;
}