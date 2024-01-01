document.getElementById("disease_name").addEventListener("change", getDiseaseName);

function getDiseaseName() {
	var diseaseName = document.getElementById("disease_name").value;
    location.href = 'doctor-first-medical-history.php?selected-disease='+ diseaseName;
}