<?php include 'php/data-pharmacist-loggedin.php' ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Dispensed Prescription | E-Prescribing</title>
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
	<a  href="pharmacist-view-prescriptions.php"><b style="font-size: 14px">&#935;</b> Cancel</a>
</div>
<!-- Main Content -->
<div class="form-content">
	<?php echo '<h2>'.$_GET['med_name'].' Dispense Details</h2>'; ?>
	<?php include 'php/inc-dispense-details-table.php' ?>
</div>
<!-- Footer -->
<?php include 'php-html/footer.php'; ?>
<script src="js/filter-table.js"></script>
<script src="js/sort-table.js"></script>
<script src="js/form-validations.js"></script>
<script src="js/date.js"></script>
</body>
</html>