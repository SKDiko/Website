<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Patient Login | E-Prescribing</title>
<?php include 'php-html/head-content.php'; ?>
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/external-navbar.css">
<link rel="stylesheet" href="css/footer.css">
<link rel="stylesheet" href="css/login.css">
</head>
<body>
<!-- Header -->
<div class="header">
	<h2>
		<a href="index.php"><i class="fa fa-plus-square"></i></a>
		<a href="index.php">E-Prescribing System</a>
	</h2>
</div>
<!-- Navigation Bar -->
<div class="nav-tabs">
	<div id="active" class="tab">
		<a href="index.php">Login</a>
	</div>
	<div class="tab" style="border-left: 1px solid #04ae70;">
		<a href="patient-signup.php">Sign up</a>
	</div>
</div>
<!-- Main Content -->
<form class="form-content" action="php/data-patient-login.php" method="POST" autocomplete="off"> 
	<h2>Login</h2>
	
	<label for="user_name">Username:</label><br>
	<input type="text" name="user_name" id="user_name" autofocus required><br>

	<label for="pswd">Password:</label><br>
	<input type="password" name="pswd" id="pswd" required><br>
    
	<input type="submit" name="btnLogin" id="btnLogin" value="Submit" onclick="cookiesEnabled()">
	<label><a href="patient-reset-password.php" title="Reset your password">Forgot&nbsp;Password?</a></label>
	<br>
	<!-- Footer -->
	<?php include 'php-html/footer.php'; ?>
</form>
<script src="js/checkCookies.js"></script>
<script src="js/date.js"></script>
</body>
</html>