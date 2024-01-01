document.getElementById("disease_name").addEventListener("change", getDiseaseName);

function getDiseaseName() {
	var diseaseName = document.getElementById("disease_name").value;
    location.href = 'doctor-update-prescriptions.php?selected-disease='+ diseaseName;
}