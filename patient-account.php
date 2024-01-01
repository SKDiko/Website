<?php include 'php/data-patient-loggedin.php' ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Patient Account | E-Prescribing</title>
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
	<a href="patient-allergy-history.php">Allergy History</a>
	<a id="active" href="patient-account.php">My Account</a>
	<a href="javascript:void(0);" class="icon" onclick="ResponsiveNav()">&#9776;</a>
</div>
<script src="http://localhost/Rez-Online-App/js/responsiveNav.js"></script>
<!-- Main Content -->
<form class="form-content" action="php/data-patient-update.php" method="POST" enctype="multipart/form-data" autocomplete="on">
	<h2>Patient Account</h2>
	<?php
	echo '
	<fieldset>
		<legend>Personal Details</legend>

		<label for="id_num">ID Number:</label><br>
		<input type="text" name="id_num" id="id_num" value="'.$_SESSION['pat_id_num'].'" title="This field cannot be changed." disabled><br>

		<label for="name">First Names:</label><br>
		<input type="text" name="name" id="name" value="'.$_SESSION['pat_name'].'" title="This field cannot be changed." disabled><br>

		<label for="surname">Surname:</label><br>
		<input type="text" name="surname" id="surname" value="'.$_SESSION['pat_surname'].'" title="This field cannot be changed." disabled><br>

		<label for="birth">Date Of Birth:</label><br>
		<input type="text" name="birth" id="birth" value="'.$_SESSION['pat_birth'].'" title="This field cannot be changed." disabled><br>

		<label for="gender">Gender:</label><br>
		<input type="text" name="gender" id="gender" value="'.$_SESSION['pat_gender'].'" title="This field cannot be changed." disabled><br>
	</fieldset>
    
	<fieldset>
		<legend>Address</legend>

		<label for="province">Province Name:</label><br>
		<select id="province" name="province" required>
			<option selected value="'.$_SESSION['pat_province'].'">'.$_SESSION['pat_province'].'</option>
			<option value="Eastern Cape">Eastern Cape</option>
        	<option value="Free State">Free State</option>
            <option value="Gauteng">Gauteng</option>
            <option value="KwaZulu-Natal">KwaZulu-Natal</option>
            <option value="Limpopo">Limpopo</option>
        	<option value="Mpumalanga">Mpumalanga</option>
            <option value="North West">North West</option>
            <option value="Northern Cape">Northern Cape</option>
            <option value="Western Cape">Western Cape</option>
		</select><br>

		<label for="town">Town Name:</label><br>
		<select id="town" name="town" required>
			<option selected value="'.$_SESSION['pat_town'].'">'.$_SESSION['pat_town'].'</option>
			<option id="Bhisho" value="Bhisho">Bhisho</option>
			<option id="Bloemfontein" value="Bloemfontein">Bloemfontein</option>
			<option id="Cape_Town" value="Cape Town">Cape Town</option>
			<option id="Durban" value="Durban">Durban</option>
			<option id="Gqeberha" value="Gqeberha">Gqeberha</option>
			<option id="Johannesburg" value="Johannesburg">Johannesburg</option>
			<option id="Kimberley" value="Kimberley">Kimberley</option>
			<option id="Mahikeng" value="Mahikeng">Mahikeng</option>
			<option id="Mbombela" value="Mbombela">Mbombela</option>
			<option id="Pietermarizburg" value="Pietermarizburg">Pietermarizburg</option>
			<option id="Polokwane" value="Polokwane">Polokwane</option>
		</select><br>

		<label for="suburb">Suburb Name:</label><br>
		<select id="suburb" name="suburb" required>
			<option selected value="'.$_SESSION['pat_suburb'].'">'.$_SESSION['pat_suburb'].'</option>
			<option id="Algoa_Park" value="Algoa Park">Algoa Park</option>
			<option id="Barberton" value="Barberton">Barberton</option>
			<option id="Bluff" value="Bluff">Bluff</option>
			<option id="Bridgemead" value="Bridgemead">Bridgemead</option>
			<option id="Cato_Manor" value="Cato Manor">Cato Manor</option>
			<option id="Cotswold" value="Cotswold">Cotswold</option>
			<option id="Essenwood" value="Essenwood">Essenwood</option>
			<option id="Glenmore" value="Glenmore">Glenmore</option>
			<option id="Greyville" value="Greyville">Greyville</option>
			<option id="Humewood" value="Humewood">Humewood</option>
			<option id="Inanda" value="Inanda">Inanda</option>
			<option id="Kamagugu" value="Kamagugu">Kamagugu</option>
			<option id="Kenville" value="Kenville">Kenville</option>
			<option id="Kwamashu" value="Kwamashu">Kwamashu</option>
			<option id="Malabar" value="Malabar">Malabar</option>
			<option id="Musgrave" value="Musgrave">Musgrave</option>
			<option id="Lorraine" value="Lorraine">Lorraine</option>
			<option id="Riverside" value="Riverside">Riverside</option>
			<option id="Struandale" value="Struandale">Struandale</option>
			<option id="Summerstrand" value="Summerstrand">Summerstrand</option>
			<option id="Tongaat" value="Tongaat">Tongaat</option>
			<option id="Valencia_Park" value="Valencia Park">Valencia Park</option>
		</select><br>
		
		<label for="line1">Address Line 1:</label><br>
		<input type="text" name="line1" id="line1" value="'.$_SESSION['pat_line1'].'"><br>

		<label for="line2">Address Line 2:</label><br>
		<input type="text" name="line2" id="line2" value="'.$_SESSION['pat_line2'].'"><br>

		<label for="code">Postal Code:</label><br>
        <input type="text" name="code" id="code" value="'.$_SESSION['pat_code'].'" required readonly><br>
	</fieldset>
		
	<fieldset>
		<legend>Contact Details</legend>

		<label for="contact_num">Contact Number:</label><br>
		<input type="tel" name="contact_num" id="contact_num" value="'.$_SESSION['pat_contact_num'].'" pattern="[0-9]{10}" title="Contact Number must contain 10 numbers." required><br>

		<label for="email">Email:</label><br>
		<input type="email" name="email" value="'.$_SESSION['pat_email'].'" id="email"  autocomplete="off" required><br>
		
		<label for="verify_email">Verify Email:</label><br> 
		<input type="email" name="verify_email" id="verify_email" autocomplete="off" required><br>
		
		<div class="validation">
			<span id="matchEmail" class="invalid"><i class="fa">&#xf058;</i> Emails must match</span><br> 
		</div>
	</fieldset>
	';?>
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
	
</form>
<!-- Footer -->
<?php include 'php-html/footer.php'; ?>
<script src="js/sort-input-elements.js"></script>
<script src="js/select_address.js"></script>
<script src="js/form-validations.js"></script>
<script src="js/date.js"></script>
</body>
</html>