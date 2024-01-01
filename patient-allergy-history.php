<?php include 'php/data-patient-loggedin.php' ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<title>View Allergy History | E-Prescribing</title>
<?php include 'php-html/head-content.php'; ?>
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/internal-navbar.css">
<link rel="stylesheet" href="css/table.css">
<link rel="stylesheet" href="css/sign-up.css">
<link rel="stylesheet" href="css/footer.css">
</head>
<body>
<!-- Header -->
<div class="header">
	<h2>
		<a href="patient-home.php"><i class="fa fa-plus-square"></i></a>
		<a href="patient-home.php">E-Prescribing System</a>
		<form action="php/data-patient-logout.php" method="POST">
			<button name="btnlogout" id="btnlogout">log out</button>
		</form>
	</h2>
</div>
<!-- Navigation Bar -->
<div class="topnav" id="myTopnav">
	<a href="patient-home.php">Home</a>
	<a href="patient-medication-history.php">Medication History</a>
	<a href="patient-disease-history.php">Disease History</a>
	<a id="active" href="patient-allergy-history.php">Allergy History</a>
	<a href="patient-account.php">My Account</a>
	<a href="javascript:void(0);" class="icon" onclick="ResponsiveNav()">&#9776;</a>
	<input type="text" id="myInput" onkeyup="search_table(4)" placeholder="Search for allergy...">
</div>
<script src="http://localhost/Rez-Online-App/js/responsiveNav.js"></script>
<!-- Main Content -->
<h2>View Allergy History</h2>
<?php include 'php/inc-patient-allergy-history-table.php'; ?>
<!-- Footer -->
<?php include 'php-html/footer.php'; ?>
<script src="js/filter-table.js"></script>
<script src="js/sort-table.js"></script>
<script src="js/form-validations.js"></script>
<script src="js/date.js"></script>
</body>
</html>