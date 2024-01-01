<?php include 'php/data-doctor-loggedin.php' ?>
<?php include 'php/inc-search-patient-data.php' ?>
<?php include 'php/inc-patient-selected-disease-data.php' ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>First Visit Medical History | E-Prescribing</title>
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
	<button class="dropbtn" id="active">First Visit Details <i class="fa fa-caret-down"></i></button>
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
	<button class="dropbtn">Prescriptions <i class="fa fa-caret-down"></i></button>
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
<form class="form-content" action="php/data-doctor-first-medical-history-search-patient.php" method="POST" enctype="multipart/form-data" autocomplete="on">
	<h2>First Visit Medical History</h2>

	<fieldset>
		<legend>Search Patient</legend>
		<?php include 'php/inc-search-patient.php'; ?>
		<input type="submit" value="Search" id="btnSearch" name="btnSearch"><br>
	</fieldset>
</form>
<form class="form-content" action="php/data-doctor-first-medical-history.php" method="POST" enctype="multipart/form-data" autocomplete="on">

	<fieldset>
		<legend>Patient Personal Details</legend>
		<?php echo '
		<label for="pat_id">ID Number:</label><br>
		<input type="text" name="pat_id" id="pat_id" value="'.$_SESSION['first_visit_id_num'].'" disabled><br>
		
		<label for="pat_name">Patient Name:</label><br>
		<input type="text" name="pat_name" id="pat_name" value="'.$_SESSION['first_visit_name'].' '.$_SESSION['first_visit_surname'].'" disabled><br>

		<label for="pat_age">Patient Age:</label><br>
		<input type="text" name="pat_age" id="pat_age" value="'.$_SESSION['first_visit_age'].'" disabled><br>

		<label for="pat_gender">Gender:</label><br>
		<input type="text" name="pat_gender" id="pat_gender" value="'.$_SESSION['first_visit_gender'].'" disabled><br>
		
		<label for="pat_address">Address:</label><br>
		<textarea name="pat_address" rows="6" disabled>
'.$_SESSION['first_visit_street'].'
'.$_SESSION['first_visit_suburb'].'
'.$_SESSION['first_visit_town'].'
'.$_SESSION['first_visit_province'].'
'.$_SESSION['first_visit_code'].'
		</textarea><br>

		<label for="pat_contact_num">Contact Number:</label><br>
		<input type="text" name="pat_contact_num" id="pat_contact_num" value="'.$_SESSION['first_visit_contact_num'].'" disabled><br>

		<label for="email">Email:</label><br>
		<input type="email" name="email" value="'.$_SESSION['first_visit_email'].'" id="email" disabled><br>
	</fieldset>
	';?>

	<fieldset>
		<legend>Medical History</legend>
		<?php include 'php/inc-get-patient-diseases.php'; ?>
		<?php include 'php/inc-get-patient-medication.php'; ?>
        
	    <label for="med_date">Date:</label><br>
	    <?php echo '<input type="date" name="med_date" id="med_date" max="'.date("Y-m-d").'"><br>'; ?>
	</fieldset>

	<fieldset class="form-submit">
		<input type="submit" value="Submit" id="btnSubmit" name="btnSubmit" onclick ="isRequired();">
		<input type="submit" value="Clear" id="btnClear" name="btnClear" onclick ="notRequired();">
	</fieldset>
</form>
<!-- Footer -->
<?php include 'php-html/footer.php'; ?>
<script src="js/med-history-required-fields.js"></script>
<script src="js/set-url.js"></script>
<script src="js/form-validations.js"></script>
<script src="js/date.js"></script>
</body>
</html>