<?php include 'php/data-pharmacist-loggedin.php' ?>
<?php //include 'php/inc-pharmacist-dispense-prescription-search-data.php' ?>
<?php
$_SESSION['view_prescriptions_pat_id_num'] = "";

if(isset($_SESSION['view-prescriptions-pat-id-num'])) {
	$_SESSION['view_prescriptions_pat_id_num'] = $_SESSION['view-prescriptions-pat-id-num'];
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Home | E-Prescribing</title>
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
		<a href="pharmacist-home.php"><i class="fa fa-plus-square"></i></a>
		<a href="pharmacist-home.php">E-Prescribing System</a>
		<form action="php/data-pharmacist-logout.php" method="POST">
			<button name="btnlogout" id="btnlogout">log out</button>
		</form>
	</h2>
</div>
<!-- Navigation Bar -->
<div class="topnav" id="myTopnav">
	<a id="active" href="pharmacist-view-prescriptions.php">Home</a>
	<a href="pharmacist-account.php">My Account</a>
	<a href="javascript:void(0);" class="icon" onclick="ResponsiveNav()">&#9776;</a>
	<input type="text" id="myInput" onkeyup="search_table(4)" placeholder="Search for medication...">
</div>
<script src="http://localhost/Rez-Online-App/js/responsiveNav.js"></script>
<!-- Main Content -->
<form class="form-content" action="php/data-view-prescriptions-search-patient.php" method="POST" enctype="multipart/form-data" autocomplete="on">
	<h2>View Prescriptions</h2>

	<fieldset>
		<legend>Search Patient</legend>
		<input type="text" name="id_num" pattern="[0-9]{13}" title="ID Number must contain 13 numbers." autofocus required>
		<input type="submit" value="Search" id="btnSearch" name="btnSearch"><br>
	</fieldset>
</form>
<div class="form-content" method="POST" enctype="multipart/form-data" autocomplete="on" style="width: 100%;">
<?php include 'php/inc-pharmacist-view-prescriptions-data-table.php'; ?>
</div>
<!-- Footer -->
<?php include 'php-html/footer.php'; ?>
<script src="js/filter-table.js"></script>
<script src="js/sort-table.js"></script>
<script src="js/form-validations.js"></script>
<script src="js/date.js"></script>
</body>
</html>