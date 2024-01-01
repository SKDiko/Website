<?php 
	if(empty($_GET["selector"]) || empty($_GET["validator"]) || empty($_GET["id"])){
		echo("<script>alert('Reset Password Unsuccessful: Something went wrong, Please try again.')</script>");
	 	echo("<script>window.location = 'patient-reset-password.php?reset-password=error';</script>");
		exit();
	}
	if(ctype_xdigit($_GET["selector"]) == false && ctype_xdigit($_GET["validator"]) == false){
		echo("<script>alert('Reset Password Unsuccessful: Something went wrong, Please try again.')</script>");
	 	echo("<script>window.location = 'patient-reset-password.php?reset-password=error';</script>");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Create New Password | E-Prescribing</title>
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
		<a href="index.php"><i class="fa fa-plus-square"></i></a>
		<a href="index.php">E-Prescribing System</a>
	</h2>
</div>
<!-- Navigation Bar -->
<div class="topnav" id="myTopnav">
	<a  href="index.php"><i class="fa">&#xf104;</i> BACK</a>
</div>
<!-- Main Content -->
<form class="form-content" action="php/data-doctor-update-password.php" method="POST" enctype="multipart/form-data" autocomplete="off">
	<h2>Create New Password</h2>

	<fieldset>
		<legend>Password</legend>

		<?php echo '
		<input type="hidden" name="selector" value="'.$_GET["selector"].'">
		<input type="hidden" name="validator" value="'.$_GET["validator"].'">
		'?>
		
		<label for="pswd">Create Password:</label><br>
		<input type="password" id="pswd" name="pswd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}" title="Password must contain at least one lowercase and uppercase letter, at least one number and must be least 7 or more characters." required>
		
		<div class="validation">
			<span id="length" class="invalid"><i class="fa">&#xf058;</i> Password must be a minimum of 7 characters</span><br>
			<span id="letter" class="invalid"><i class="fa">&#xf058;</i> Password must contain a lowercase letter</span><br>
			<span id="capital" class="invalid"><i class="fa">&#xf058;</i> Password must contain an uppercase/capital letter</span><br>
			<span id="number" class="invalid"><i class="fa">&#xf058;</i> Password must contain a number</span><br>
		</div>
		
		<label for="confirm_pswd">Confirm Password:</label><br>
		<input type="password" id="confirm_pswd" name="confirm_pswd" required><br>
		
		<div class="validation">
			<span id="matchPass" class="invalid"><i class="fa">&#xf058;</i> Passwords must match</span><br> 
		</div>
		
		<input type="submit" value="Submit" id="btnResetPass" name="btnResetPass">
	</fieldset>
</form>
<!-- Footer -->
<?php include 'php-html/footer.php'; ?>
<script src="js/form-validations.js"></script>
<script src="js/date.js"></script>
</body>
</html>