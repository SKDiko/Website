<?php include 'php/data-doctor-loggedin.php' ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Medication | E-Prescribing</title>
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
		<a href="doctor-home"><i class="fa fa-plus-square"></i></a>
		<a href="doctor-home">E-Prescribing System</a>
	</h2>
</div>
<!-- Navigation Bar -->
<div class="topnav" id="myTopnav">
	<a  href="doctor-load-prescriptions.php"><b style="font-size: 14px">&#935;</b> Cancel</a>
</div>
<!-- Main Content -->
<form class="form-content" method="POST" enctype="multipart/form-data" autocomplete="on" style="width: 100%;">
	<h2>Medication Details</h2>
	<?php include 'php/inc-medication-details-table.php'; ?>
</form>
<!-- Footer -->
<?php include 'php-html/footer.php'; ?>
<script src="js/sort-table.js"></script>
</body>
</html>