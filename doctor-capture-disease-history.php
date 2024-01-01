<?php include 'php/data-doctor-loggedin.php' ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Capture Disease History | E-Prescribing</title>
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
		<a href="doctor-home.php"><i class="fa fa-plus-square"></i></a>
		<a href="doctor-home.php">E-Prescribing System</a>
		<form action="php/data-doctor-logout.php" method="POST">
			<button name="btnlogout" id="btnlogout">log out</button>
		</form>
	</h2>
</div>
<!-- Navigation Bar -->
<div class="topnav" id="myTopnav">
	<a href="doctor-home.php">Home <i class="fa fa-caret-right"></i></a>
	<a id="active" href="doctor-capture-disease-history.php">Disease History <i class="fa fa-caret-right"></i></a>
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
	<input type="text" id="myInput" onkeyup="search_table(2)" placeholder="Search for disease...">
</div>
<script src="http://localhost/Rez-Online-App/js/responsiveNav.js"></script>
<!-- Main Content -->
<form class="form-content" action="php/data-doctor-capture-disease-history.php" method="POST" enctype="multipart/form-data" autocomplete="on">
	<h2>Capture Disease History</h2>
	<fieldset>
		<legend>Disease History</legend>
		<?php include 'php/inc-get-patient-diseases.php'; ?>
        
	    <label for="med_date">Date:</label><br>
	    <?php echo '<input type="date" name="med_date" id="med_date" max="'.date("Y-m-d").'" required><br>'; ?>
	</fieldset>

	<fieldset class="form-submit">
		<input type="submit" value="Submit" id="btnSubmit" name="btnSubmit" onclick ="isRequired();">
		<input type="reset" value="Clear" id="btnClear" name="btnClear">
	</fieldset>
</form>
<br><br>
<div class="form-content">
	<?php include 'php/inc-capture-disease-history-table.php'; ?>

	<fieldset class="form-submit">
		<br>
		<a href="doctor-home.php"><input type="submit" value="Prev" id="btnSubmit"></a>
		<a href="doctor-capture-medication-history.php"><input type="submit" value="Next" id="btnClear"></a>
	</fieldset>
</div>

<!-- Footer -->
<?php include 'php-html/footer.php'; ?>

<script src="js/filter-table.js"></script>
<script src="js/sort-table.js"></script>
<script src="js/med-history-required-fields.js"></script>
<script src="js/form-validations.js"></script>
<script src="js/date.js"></script>
</body>
</html>