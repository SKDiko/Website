<?php include 'php/data-doctor-loggedin.php' ?>
<?php include 'php/inc-doctor-med-history-search-patient-data.php' ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Doctor Home | E-Prescribing</title>
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
	<a id="active" href="doctor-home.php">Home <i class="fa fa-caret-right"></i></a>
	<a href="doctor-capture-disease-history.php">Disease History <i class="fa fa-caret-right"></i></a>
	<a href="doctor-capture-medication-history.php">Medication History <i class="fa fa-caret-right"></i></a>
	<a href="doctor-capture-allergy-history.php">Allergy History <i class="fa fa-caret-right"></i></a>
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
<form class="form-content" action="php/data-doctor-first-allergy-history-search-patient.php" method="POST" enctype="multipart/form-data" autocomplete="on">
	<h2>Find Patient</h2>

	<fieldset>
		<legend>Search Patient</legend>
		<input type="text" name="id_num" pattern="[0-9]{13}" title="ID Number must contain 13 numbers." autofocus required>
		<input type="submit" value="Search" id="btnSearch" name="btnSearch"><br>
	</fieldset>
</form>
<form class="form-content" action="php/data-doctor-med-history.php" method="POST" enctype="multipart/form-data" autocomplete="on">

	<fieldset>
		<legend>Patient Personal Details</legend>
		<?php echo '
		<label for="pat_id">ID Number:</label><br>
		<input type="text" name="pat_id" id="pat_id" value="'.$_SESSION['med_history_id_num'].'" disabled><br>
		
		<label for="pat_name">Patient Name:</label><br>
		<input type="text" name="pat_name" id="pat_name" value="'.$_SESSION['med_history_name'].' '.$_SESSION['med_history_surname'].'" disabled><br>

		<label for="pat_age">Patient Age:</label><br>
		<input type="text" name="pat_age" id="pat_age" value="'.$_SESSION['med_history_age'].'" disabled><br>

		<label for="pat_gender">Gender:</label><br>
		<input type="text" name="pat_gender" id="pat_gender" value="'.$_SESSION['med_history_gender'].'" disabled><br>
		
		<label for="pat_address">Address:</label><br>
		<textarea name="pat_address" rows="7" disabled>
'.$_SESSION['med_history_line1'].'
'.$_SESSION['med_history_line2'].'
'.$_SESSION['med_history_suburb'].'
'.$_SESSION['med_history_town'].'
'.$_SESSION['med_history_province'].'
'.$_SESSION['med_history_code'].'
		</textarea><br>

		<label for="pat_contact_num">Contact Number:</label><br>
		<input type="text" name="pat_contact_num" id="pat_contact_num" value="'.$_SESSION['med_history_contact_num'].'" disabled><br>

		<label for="email">Email:</label><br>
		<input type="email" name="email" value="'.$_SESSION['med_history_email'].'" id="email" disabled><br>
	</fieldset>
	';?>

	<fieldset class="form-submit">
		<input type="submit" value="Next" id="btnNext" name="btnNext">
		<input type="submit" value="Clear" id="btnClear" name="btnClear">
	</fieldset>
</form>
<!-- Footer -->
<?php include 'php-html/footer.php'; ?>
<script src="js/date.js"></script>
</body>
</html>