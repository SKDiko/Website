<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Pharmacist Reset Password | E-Prescribing</title>
<?php include 'php-html/head-content.php'; ?>
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/internal-navbar.css">
<link rel="stylesheet" href="css/login.css">
<link rel="stylesheet" href="css/footer.css">
</head>
<body>
<!-- Header -->
<div class="header">
	<h2>
		<a href="pharmacist-login.php"><i class="fa fa-plus-square"></i></a>
		<a href="pharmacist-login.php">E-Prescribing System</a>
	</h2>
</div>
<!-- Navigation Bar -->
<div class="topnav" id="myTopnav">
	<a  href="pharmacist-login.php"><i class="fa">&#xf104;</i> BACK</a>
</div>
<!-- Main Content -->
<form class="form-content" action="php/data-pharmacist-reset-password.php" method="POST" autocomplete="off"> 
	<h2>Pharmacist Reset Password</h2>
		<label for="user_name">Username:</label><br>
		<input type="text" name="user_name" id="user_name" placeholder="Email or Registration Number" autofocus required>
		<input type="submit" name="btnReset" value="Submit">
		<!-- Footer -->
		<?php include 'php-html/footer.php'; ?>
</form>
<script src="js/date.js"></script>
</body>
</html>