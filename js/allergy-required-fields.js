function isRequired() {
  document.getElementById("allergy_name").required = true;
  document.getElementById("med_date").required = true;
}

function notRequired() {
  document.getElementById("allergy_name").required = false;
  document.getElementById("med_date").required = false;
}