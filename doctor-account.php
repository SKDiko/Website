<?php include 'php/data-doctor-loggedin.php' ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Doctor Account | E-Prescribing</title>
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
	<button class="dropbtn">Prescriptions <i class="fa fa-caret-down"></i></button>
		<div class="dropdown-content">
			<a href="doctor-load-prescriptions.php">Load Prescriptions</a>
			<a href="doctor-update-prescriptions.php">Update Prescriptions</a>
		</div>
  	</div>
  	<a id="active" href="doctor-account.php">My Account</a>
	<a href="javascript:void(0);" class="icon" onclick="ResponsiveNav()">&#9776;</a>
</div>
<script src="http://localhost/Rez-Online-App/js/responsiveNav.js"></script>
<!-- Main Content -->
<form class="form-content" action="php/data-doctor-update.php" method="POST" enctype="multipart/form-data" autocomplete="on">
	<h2>Doctor Account</h2>
	<?php
	echo '
	<fieldset>
		<legend>Personal Details</legend>

		<label for="reg_num">Registration Number:</label><br>
		<input type="text" name="reg_num" id="reg_num" value="'.$_SESSION['doc_reg_num'].'" title="This field cannot be changed." disabled><br>

		<label for="name">First Names:</label><br>
		<input type="text" name="name" id="name" value="'.$_SESSION['doc_name'].'" title="This field cannot be changed." disabled><br>

		<label for="surname">Surname:</label><br>
		<input type="text" name="surname" id="surname" value="'.$_SESSION['doc_surname'].'" title="This field cannot be changed." disabled><br>

		<label for="qualification">Highest Qualification:</label><br>
		<select id="qualification" name="qualification" required>
			<option selected value="'.$_SESSION['doc_qualification'].'">'.$_SESSION['doc_qualification'].'</option>
			<option value="Bachelors Degree">Bachelors Degree</option>
			<option value="Honours Degree">Honours Degree</option>
			<option value="Masters Degree">Masters Degree</option>
			<option value="Doctorate">Doctorate</option>
		</select><br>
	</fieldset>

	<fieldset>
		<legend>Medical Practice</legend>

		<label for="practice_name">Name:</label><br>
		<select name="practice_name" id="practice_name" required>
			<option selected value="'.$_SESSION['doc_practice_num'].'">'.$_SESSION['med_practice_name'].'</option>';?>
			<?php include 'php/med_practice_names.php' ?>
		<?php echo '
		</select><br>

		<label for="practice_address">Address:</label><br>
		<textarea name="practice_address" id="practice_address" rows="7" title="This field cannot be changed." disabled>
'.$_SESSION['med_practice_line1'].'
'.$_SESSION['med_practice_line2'].'
'.$_SESSION['med_practice_suburb'].'
'.$_SESSION['med_practice_town'].'
'.$_SESSION['med_practice_province'].'
'.$_SESSION['med_practice_code'].'
		</textarea><br>

		<label for="practice_contact_num">Contact Number:</label><br>
		<input type="text" name="practice_contact_num" id="practice_contact_num" value="'.$_SESSION['med_practice_contact_num'].'" title="This field cannot be changed." disabled><br>

		<label for="practice_email">Email:</label><br>
		<input type="email" name="practice_email" id="practice_email" value="'.$_SESSION['med_practice_email'].'" title="This field cannot be changed." disabled><br>
	</fieldset>
		
	<fieldset>
		<legend>Contact Details</legend>

		<label for="contact_num">Contact Number:</label><br>
		<input type="tel" name="contact_num" id="contact_num" value="'.$_SESSION['doc_contact_num'].'" pattern="[0-9]{10}" title="Contact Number must contain 10 numbers." required><br>

		<label for="email">Email:</label><br>
		<input type="email" name="email" value="'.$_SESSION['doc_email'].'" id="email"  autocomplete="off" required><br>
		
		<label for="verify_email">Verify Email:</label><br> 
		<input type="email" name="verify_email" id="verify_email" autocomplete="off" required><br>
		
		<div class="validation">
			<span id="matchEmail" class="invalid"><i class="fa">&#xf058;</i> Emails must match</span><br> 
		</div>
	</fieldset>
		
	<fieldset>
		<legend>Password</legend>
		
		<label for="pswd">Create New Password:</label><br>
		<input type="password" id="pswd" name="pswd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}" title="Password must contain at least one lowercase and uppercase letter, at least one number and must be least 7 or more characters." required>
		
		<div class="validation">
			<span id="length" class="invalid"><i class="fa">&#xf058;</i> Password must be a minimum of 7 characters</span><br>
			<span id="letter" class="invalid"><i class="fa">&#xf058;</i> Password must contain a lowercase letter</span><br>
			<span id="capital" class="invalid"><i class="fa">&#xf058;</i> Password must contain an uppercase/capital letter</span><br>
			<span id="number" class="invalid"><i class="fa">&#xf058;</i> Password must contain a number</span><br>
		</div>
		
		<label for="confirm_pswd">Confirm New Password:</label><br>
		<input type="password" id="confirm_pswd" name="confirm_pswd" required><br>
		
		<div class="validation">
			<span id="matchPass" class="invalid"><i class="fa">&#xf058;</i> Passwords must match</span><br> 
		</div>

		<label for="current_pswd">Current Password:</label><br>
		<input type="password" id="current_pswd" name="current_pswd" required><br>
	</fieldset>

	<fieldset class="form-submit">
		<input type="submit" value="Update" id="btnSubmit" name="btnSubmit">
	</fieldset>
	';?>
</form>
<!-- Footer -->
<?php include 'php-html/footer.php'; ?>
<script src="js/form-validations.js"></script>
<script src="js/date.js"></script>
</body>
</html>