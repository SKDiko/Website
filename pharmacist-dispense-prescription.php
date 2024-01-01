<?php include 'php/data-pharmacist-loggedin.php' ?>
<?php include 'php/inc-pharmacist-dispense-prescription-search-data.php' ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Dispense Prescription | E-Prescribing</title>
<?php include 'php-html/head-content.php'; ?>
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/internal-navbar.css">
<link rel="stylesheet" href="css/sign-up.css">
<link rel="stylesheet" href="css/table.css">
<link rel="stylesheet" href="css/footer.css">
</head>
<body>
<!-- Header -->
<div class="header">
	<h2>
		<a href="pharmacist-home.php"><i class="fa fa-plus-square"></i></a>
		<a href="pharmacist-home.php">E-Prescribing System</a>
		<form action="php/data-pharmacist-logout.php" method="POST">
			<button name="btnlogout" id="btnlogout">log out</button>
		</form>
	</h2>
</div>
<!-- Navigation Bar -->
<div class="topnav" id="myTopnav">
	<a href="pharmacist-home.php">Home</a>
	<a href="pharmacist-view-prescriptions.php">View Prescriptions</a>
	<a id="active" href="pharmacist-dispense-prescription.php">Dispense Prescription</a>
	<a href="javascript:void(0);" class="icon" onclick="ResponsiveNav()">&#9776;</a>
</div>
<script src="http://localhost/Rez-Online-App/js/responsiveNav.js"></script>
<!-- Main Content -->
<form class="form-content" action="php/data-dispense-prescription-search-patient.php" method="POST" enctype="multipart/form-data" autocomplete="on">
	<h2>Dispense Prescription</h2>

	<fieldset>
		<legend>Search Patient</legend>
		<?php include 'php/inc-search-patient.php'; ?>
		<input type="submit" value="Search" id="btnSearch" name="btnSearch"><br>
	</fieldset>
</form>

<form class="form-content">
	<fieldset>
		<legend>Patient Details</legend>
		<?php echo '
		<label for="pat_id">ID Number:</label><br>
		<input type="text" name="pat_id" id="pat_id" value="'.$_SESSION['dispense_pat_id_num'].'" disabled><br>

		<label for="pat_name">Patient Name:</label><br>
		<input type="text" name="pat_name" id="pat_name" value="'.$_SESSION['dispense_pat_name'].' '.$_SESSION['dispense_pat_surname'].'" disabled><br>

		<label for="pat_age">Patient Age:</label><br>
		<input type="text" name="pat_age" id="pat_age" value="'.$_SESSION['dispense_pat_age'].'" disabled><br>

		<label for="pat_gender">Gender:</label><br>
		<input type="text" name="pat_gender" id="pat_gender" value="'.$_SESSION['dispense_pat_gender'].'" disabled><br>

	</fieldset>
	';?>

	<fieldset style="max-height: 210px; overflow: auto;">
		<legend>Medical History</legend>
		<?php include 'php/inc-search-medical-history.php'; ?>
	</fieldset>

	<fieldset style="max-height: 210px; overflow: auto;">
		<legend>Allergy History</legend>
		<?php include 'php/inc-search-allergy-history.php'; ?>
	</fieldset>
</form>

<form class="form-content" action="php/data-dispense-prescription-search-prescription.php" method="POST" enctype="multipart/form-data" autocomplete="on">
	<fieldset>
		<legend>Search Prescription</legend>
		<?php include 'php/inc-search-prescription.php'; ?>
		<input type="submit" value="Search" id="btnSearch" name="btnSearch"><br>
	</fieldset>
</form>

<form class="form-content" action="php/data-dispense-prescription.php?dispense_days_checked=no" method="POST" enctype="multipart/form-data" autocomplete="on">

	<fieldset>
		<legend>Doctor Details</legend>
	<?php echo '
		<label for="doc_name">Doctor Name:</label><br>
		<input type="text" name="doc_name" id="pat_name" value="'.$_SESSION['dispense_doc_surname'].' '.$_SESSION['dispense_doc_name'].'" disabled><br>

		<label for="doc_contact_num">Contact Number:</label><br>
		<input type="text" name="doc_contact_num" id="doc_contact_num" value="'.$_SESSION['dispense_doc_contact_num'].'" disabled><br>

		<label for="doc_email">Email:</label><br>
		<input type="text" style="text-transform: lowercase;" name="doc_email" id="doc_email" value="'.$_SESSION['dispense_doc_email'].'" disabled><br>

		<label for="doc_medical_practice">Medical Practice:</label><br>
		<input type="text" name="doc_medical_practice" id="doc_medical_practice" value="'.$_SESSION['dispense_doc_medical_practice'].'" disabled><br>

	</fieldset>
	';?>
	

	<fieldset>
		<legend>Prescription Details</legend>
	<?php echo '
		<label for="prescription_id">Prescription ID:</label><br>
		<input type="tel" name="prescription_id" value="'.$_SESSION['dispense_prescription_id'].'" disabled><br>

		<label for="prescription_date">Prescription Date:</label><br>
		<input type="text" name="prescription_date" value="'.$_SESSION['dispense_prescription_date'].'" disabled><br>

		<label for="prescription_disease">Disease Name:</label><br>
		<input type="text" name="prescription_disease" value="'.$_SESSION['dispense_prescription_disease'].'" disabled><br>

		<label for="prescription_medication">Medication Name:</label><br>
		<input type="text" name="prescription_medication" value="'.$_SESSION['dispense_prescription_medication'].'" disabled><br>

		<label for="prescription_dosage">Dosage Form:</label><br>
		<input type="text" name="prescription_dosage" value="'.$_SESSION['dispense_prescription_dosage'].'" disabled><br>

		<label for="prescription_schedule">Schedule:</label><br>
		<input type="text" name="prescription_schedule" value="'.$_SESSION['dispense_prescription_schedule'].'" disabled><br>

		<label for="prescription_act_ingredients">Active Ingredients & Strength:</label><br>
		<textarea name="prescription_act_ingredients" rows="6" disabled>'.$_SESSION['dispense_prescription_act_ingredients'].'</textarea><br>

	    <label for="prescription_quantity">Quantity:</label><br>
	    <input type="text" name="prescription_quantity" value="'.$_SESSION['dispense_prescription_quantity'].'" disabled><br>

	    <label for="prescription_original_repeats">Original Repeats:</label><br>
	    <input type="text" name="prescription_original_repeats" value="'.$_SESSION['dispense_prescription_original_repeats'].'" disabled><br>

	    <label for="prescription_current_repeats">Current Repeats:</label><br>
	    <input type="text" name="prescription_current_repeats" value="'.$_SESSION['dispense_prescription_current_repeats'].'" disabled><br>

	    <label for="prescription_status">Status:</label><br>
		<input type="text" name="prescription_status" value="'.$_SESSION['dispense_prescription_status'].'" disabled><br>

	    <label for="prescription_instructions">Instructions:</label><br>
		<textarea name="prescription_instructions" rows="6" disabled>'.$_SESSION['dispense_prescription_instructions'].'</textarea><br>

		<label for="last_dispense_date">Last Dispense Date:</label><br>
		<input type="text" name="last_dispense_date" value="'.$_SESSION['dispense_prescription_latest_date'].'" disabled><br>

	    <label for="dispense_date">Current Dispense Date:</label><br>
	    <input type="date" name="dispense_date" id="dispense_date" value="'.date("Y-m-d").'" max="'.date("Y-m-d").'" required><br>';
	   ?>
	</fieldset>

	<fieldset class="form-submit">
		<input type="submit" value="Dispense" id="btnSubmit" name="btnSubmit">
		<input type="submit" value="Reject" id="btnClear" name="btnReject">
	</fieldset>
</form>
<!-- Footer -->
<?php include 'php-html/footer.php'; ?>
<script src="js/form-validations.js"></script>
<script src="js/date.js"></script>
</body>
</html>