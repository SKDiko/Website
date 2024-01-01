function isRequired() {
  document.getElementById("medication").required = true;
  document.getElementById("med_date").required = true;
}

function notRequired() {
  document.getElementById("medication").required = false;
  document.getElementById("med_date").required = false;
}