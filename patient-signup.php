<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Patient Signup | E-Prescribing</title>
<?php include 'php-html/head-content.php'; ?>
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/external-navbar.css">
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
<div class="nav-tabs">
	<div class="tab">
		<a href="index.php">Login</a>
	</div>
	<div id="active" class="tab" style="border-left: 1px solid #04ae70;">
		<a href="patient-signup.php">Sign up</a>
	</div>
</div>
<!-- Main Content -->
<form class="form-content" action="php/data-patient-signup.php" method="POST" enctype="multipart/form-data" autocomplete="on">
	<h2>Patient Sign Up</h2>

	<fieldset>
		<legend>Personal Details</legend>

		<label for="name">First Names:</label><br>
		<input type="text" name="name" id="name" pattern="[A-Z a-z]{0,}" title="First Name must contain alphabetic characters only." required autofocus><br>

		<label for="surname">Surname:</label><br>
		<input type="text" name="surname" id="surname" pattern="[A-Z a-z]{0,}" title="Surname must contain alphabetic characters only." required><br>

		<label for="birth">Date Of Birth:</label><br>
		<input type="date" name="birth" id="birth" required><br>

		<label for="id_num">ID Number:</label><br>
		<input type="text" name="id_num" id="id_num" pattern="[0-9]{13}" title="ID Number must contain 13 numbers." required><br>

		<label for="gender">Gender:</label>
		<input type="radio" id="male" name="gender" value="Male" required> Male 
		<input type="radio" id="female" name="gender" value="Female" required> Female<br>
	</fieldset>

	<fieldset>
		<legend>Address</legend>

		<label for="province">Province Name:</label><br>
		<select id="province" name="province" onfocus="sortListInput('province')" required>
			<option selected disabled></option>
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
		<select id="town" name="town" onfocus="sortListInput('town')" required>
			<option selected disabled></option>
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
		<select id="suburb" name="suburb" onfocus="sortListInput('suburb')" required>
			<option selected disabled></option>
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
		<input type="text" name="line1" id="line1"><br>

		<label for="line2">Address Line 2:</label><br>
		<input type="text" name="line2" id="line2"><br>

		<label for="code">Postal Code:</label><br>
        <input type="text" name="code" id="code"  required readonly><br>
		
	</fieldset>
	
	<fieldset>
		<legend>Contact Details</legend>

		<label for="contact_num">Contact Number:</label><br>
		<input type="tel" name="contact_num" id="contact_num" pattern="[0-9]{10}" title="Contact Number must contain 10 numbers." required><br>

		<label for="email">Email:</label><br>
		<input type="text" name="email" id="email"  pattern='[^"]+\.com' style="text-transform: none;" autocomplete="off" title="Invalid email." required><br>
		
		<label for="verify_email">Verify Email:</label><br> 
		<input type="email" name="verify_email" id="verify_email" autocomplete="off" required><br>
		
		<div class="validation">
			<span id="matchEmail" class="invalid"><i class="fa">&#xf058;</i> Emails must match</span><br> 
		</div>
	</fieldset>
		
	<fieldset>
		<legend>Password</legend>
		
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
	</fieldset>

	<fieldset class="form-submit">
		<input type="submit" value="Submit" id="btnSubmit" name="btnSubmit">
		<input type="reset" value="Clear" id="btnClear" name="btnClear">
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