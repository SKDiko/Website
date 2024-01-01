<?php include 'php/data-doctor-loggedin.php' ?>
<?php include 'php/inc-doctor-load-prescriptions-data.php' ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Load Prescriptions | E-Prescribing</title>
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
	<a href="doctor-capture-disease-history.php">Disease History <i class="fa fa-caret-right"></i></a>
	<a href="doctor-capture-medication-history.php">Medication History <i class="fa fa-caret-right"></i></a>
	<a href="doctor-capture-allergy-history.php">Allergy History <i class="fa fa-caret-right"></i></a>
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
<form class="form-content" action="php/data-doctor-load-prescriptions.php?allergy_checked=no&med_interaction_checked=no&med_contraindication_checked=no" method="POST" enctype="multipart/form-data" autocomplete="on">
	<h2>Load Prescriptions</h2>

	<fieldset>
		<legend>Prescription Details</legend>
		<?php include 'php/inc-get-medication.php'; ?>

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
		<input type="submit" value="Add" id="btnSubmit" name="btnSubmit" onclick ="isRequired();">
		<input type="submit" value="Clear" id="btnClear" name="btnClear" onclick ="notRequired();">
	</fieldset>
</form>
<br><br>
<?php include 'php/doctor-load-prescriptions-table.php' ?>

<form class="form-content" action="php/data-confirm-prescriptions.php" method="POST" enctype="multipart/form-data" autocomplete="on" style="width: 99.7%;">
	<br>
	<fieldset class="form-submit">
		<input type="submit" value="Confirm" id="btnSubmit" name="btnSubmit">
		<input type="submit" value="Remove" id="btnClear" name="btnClear">
	</fieldset>
</form>
<!-- Footer -->
<?php include 'php-html/footer.php'; ?>
<br>
<script src="js/load-prescriptions-required-fields.js"></script>
<script src="js/sort-table.js"></script>
<script src="js/date.js"></script>
</body>
</html>