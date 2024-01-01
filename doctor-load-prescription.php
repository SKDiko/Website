<?php include 'php/data-doctor-loggedin.php' ?>
<?php include 'php/inc-load-prescriptions-search-patient-data.php' ?>
<?php include 'php/inc-patient-selected-disease-data.php' ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Load Prescriptions | E-Prescribing</title>
<?php include 'php-html/head-content.php'; ?>
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/internal-navbar.css">
<link rel="stylesheet" href="css/sign-up.css">
<link rel="stylesheet" href="css/footer.css">
</head>
<body>
<!-- Header -->
<div class="header">
	<h2>
		<a href="doctor-home.php"><i class="fa fa-plus-square"></i></a>
		<a href="doctor-home.php">E-Prescribing System</a>
		<form action="php/data-doctor-logout.php" method="POST">
			<button name="btnlogout" id="btnlogout">log out</button>
		</form>
	</h2>
</div>
<!-- Navigation Bar -->
<div class="topnav" id="myTopnav">
	<a href="doctor-home.php">Home</a>
	<div class="dropdown">
	<button class="dropbtn">First Visit Details <i class="fa fa-caret-down"></i></button>
		<div class="dropdown-content">
			<a href="doctor-first-medical-history.php">First Visit Medical History</a>
			<a href="doctor-first-allergy-history.php">First Visit Allergy History</a>
		</div>
  	</div>
  	<div class="dropdown">
	<button class="dropbtn">Current Visit Details <i class="fa fa-caret-down"></i></button>
		<div class="dropdown-content">
			<a href="doctor-current-medical-history.php">Current Visit Medical History</a>
			<a href="doctor-current-allergy-history.php">Current Visit Allergy History</a>
		</div>
  	</div>
  	<div class="dropdown">
	<button class="dropbtn" id="active">Prescriptions <i class="fa fa-caret-down"></i></button>
		<div class="dropdown-content">
			<a href="doctor-load-prescriptions.php">Load Prescriptions</a>
			<a href="doctor-update-prescriptions.php">Update Prescriptions</a>
		</div>
  	</div>
  	<a href="doctor-account.php">My Account</a>
	<a href="javascript:void(0);" class="icon" onclick="ResponsiveNav()">&#9776;</a>
</div>
<script src="http://localhost/Rez-Online-App/js/responsiveNav.js"></script>
<!-- Main Content -->
<form class="form-content" action="php/data-load-prescriptions-search-patient.php" method="POST" enctype="multipart/form-data" autocomplete="on">
	<h2>Load Prescriptions</h2>

	<fieldset>
		<legend>Search Patient</legend>
		<?php include 'php/inc-search-patient.php'; ?>
		<input type="submit" value="Search" id="btnSearch" name="btnSearch"><br>
	</fieldset>
</form>
<form class="form-content" action="php/data-load-prescriptions.php?allergy_checked=no&med_interaction_checked=no&med_contraindication_checked=no" method="POST" enctype="multipart/form-data" autocomplete="on">

	<fieldset>
		<legend>Patient Personal Details</legend>
		<?php echo '
		<label for="pat_id">ID Number:</label><br>
		<input type="text" name="pat_id" id="pat_id" value="'.$_SESSION['load_prescription_id_num'].'" disabled><br>

		<label for="pat_name">Patient Name:</label><br>
		<input type="text" name="pat_name" id="pat_name" value="'.$_SESSION['load_prescription_name'].' '.$_SESSION['load_prescription_surname'].'" disabled><br>

		<label for="pat_age">Patient Age:</label><br>
		<input type="text" name="pat_age" id="pat_age" value="'.$_SESSION['load_prescription_age'].'" disabled><br>

		<label for="pat_gender">Gender:</label><br>
		<input type="text" name="pat_gender" id="pat_gender" value="'.$_SESSION['load_prescription_gender'].'" disabled><br>

	</fieldset>
	';?>

	<fieldset>
		<legend>Prescription Details</legend>
		<?php include 'php/inc-get-patient-diseases.php'; ?>
		<?php include 'php/inc-get-patient-medication.php'; ?>

		<label for="dosage_form">Dosage Form:</label><br>
		<select name="dosage_form" onfocus="sortListInput('dosage_form')" id="dosage_form">
		<option selected disabled></option>
			<option value="Effervescent">Effervescent</option>
			<option value="Tablet">Tablet</option>
			<option value="Capsule">Capsule</option>
			<option value="Syrup">Syrup</option>
			<option value="Powder">Powder</option>
			<option value="Spray">Spray</option>
			<option value="Injection">Injection</option>
			<option value="Inhalant">Inhalant</option>
			<option value="Oil">Oil</option>
		</select><br>

		<label for="schedule">Schedule:</label><br>
		<select name="schedule" id="schedule">
			<option selected disabled></option>
			<option value="S0">S0</option>
			<option value="S1">S1</option>
			<option value="S2">S2</option>
			<option value="S3">S3</option>
			<option value="S4">S4</option>
			<option value="S5">S5</option>
			<option value="S6">S6</option>
			<option value="S7">S7</option>
			<option value="S8">S8</option>
		</select><br>

		<label for="act_ingredients">Active Ingredients & Strength:</label><br>
		<textarea name="act_ingredients" rows="6" id="act_ingredients"></textarea><br>

	    <label for="quantity">Quantity:</label><br>
	    <input type="number" name="quantity" id="quantity" min="1"><br>

	    <label for="repeats">Repeats:</label><br>
	    <input type="number" name="repeats" id="repeats" min="1"><br>

	    <label for="instructions">Instructions:</label><br>
		<textarea name="instructions" id="instructions" rows="6"></textarea><br>
	    <label for="prescription_date">Date:</label><br>
	    <?php echo '<input type="date" name="prescription_date" id="prescription_date" value="'.date("Y-m-d").'" max="'.date("Y-m-d").'"><br>'; ?>
	</fieldset>

	<fieldset class="form-submit">
		<input type="submit" value="Submit" id="btnSubmit" name="btnSubmit" onclick ="isRequired();">
		<input type="submit" value="Clear" id="btnClear" name="btnClear" onclick ="notRequired();">
	</fieldset>
</form>
<!-- Footer -->
<?php include 'php-html/footer.php'; ?>
<br>
<script src="js/sort-input-elements.js"></script>
<script src="js/load-prescriptions-required-fields.js"></script>
<script src="js/set-url-load-prescriptions.js"></script>
<script src="js/date.js"></script>
</body>
</html>