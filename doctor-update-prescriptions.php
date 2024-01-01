<?php include 'php/data-doctor-loggedin.php' ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Update Prescriptions | E-Prescribing</title>
<?php include 'php-html/head-content.php'; ?>
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/internal-navbar.css">
<link rel="stylesheet" href="css/sign-up.css">
<link rel="stylesheet" href="css/table.css">
<link rel="stylesheet" href="css/footer.css">
<style type="text/css">
.table-container table input, select {
	border: none;
	background-color: inherit;
	width: 100%;
	
}
.table-container table input:hover, select:hover {
	border: none;
	background-color: inherit;
}
.table-container table input:focus, select:focus {
	border: none;
	outline: none;
	background-color: inherit;
}
</style>
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
<div class="form-content" style="width: 100%;">
<?php include 'php/inc-doctor-update-prescriptions-table.php' ?>
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