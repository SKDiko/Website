<?php
//Check if button submit is clicked
if (isset($_POST['btnSubmit'])) {
	//Get database connection
	include_once 'data-connection.php'; 
	//Convert data to string before enters database
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$surname = mysqli_real_escape_string($conn, $_POST['surname']);
	$birth = mysqli_real_escape_string($conn, $_POST['birth']);
	$id_num = mysqli_real_escape_string($conn, $_POST['id_num']);
	$gender = mysqli_real_escape_string($conn, $_POST['gender']);
	$pat_address = substr(md5(uniqid('', true)), 0, 10);
	$line1 = mysqli_real_escape_string($conn, $_POST['line1']);
	$line2 = mysqli_real_escape_string($conn, $_POST['line2']);
	$suburb = mysqli_real_escape_string($conn, $_POST['suburb']);
	$town = mysqli_real_escape_string($conn, $_POST['town']);
	$province = mysqli_real_escape_string($conn, $_POST['province']);
	$code = mysqli_real_escape_string($conn, $_POST['code']);
	$contact_num = mysqli_real_escape_string($conn, $_POST['contact_num']);
	$verify_email = mysqli_real_escape_string($conn, $_POST['verify_email']);
	$confirm_pswd = mysqli_real_escape_string($conn, $_POST['confirm_pswd']);
		
	//Check if patient already signed up
	$sql = "SELECT * FROM ADDRESS WHERE ADDRESS_ID ='$pat_address'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		echo("<script>alert('Signup Unsuccessful: Something went wrong, Please try again.')</script>");
 		echo("<script>window.location = '../patient-signup.php?sign-up=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	$sql = "SELECT * FROM PATIENT WHERE ID_NUMBER ='$id_num'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		echo("<script>alert('Signup Unsuccessful: Patient ".$id_num." already signed up.')</script>");
 		echo("<script>window.location = '../patient-signup.php?sign-up=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	$sql = "SELECT * FROM PATIENT WHERE EMAIL ='$verify_email'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		echo("<script>alert('Signup Unsuccessful: Email address ".$verify_email." is already taken by another patient.')</script>");
 		echo("<script>window.location = '../patient-signup.php?sign-up=error';</script>");
 		mysqli_close($conn);
		exit();
	}
	
	//Insert the user into database
	$sql1 = "INSERT INTO PATIENT (ID_NUMBER, NAME, SURNAME, DATE_OF_BIRTH, GENDER, PAT_ADDRESS, CONTACT_NUMBER, EMAIL, PASSWORD)
	VALUES ('$id_num', '$name', '$surname', '$birth', '$gender', '$pat_address', '$contact_num', '$verify_email', '$confirm_pswd');";
	if (mysqli_query($conn, $sql1)) {

  		$sql2 = "INSERT INTO ADDRESS (ADDRESS_ID, LINE1, LINE2, SUBURB, TOWN, PROVINCE, CODE)
		VALUES ('$pat_address', '$line1', '$line2', '$suburb', '$town', '$province', '$code');";
		if (mysqli_query($conn, $sql2)) {
	  		echo("<script>alert('Patient Signup Successful')</script>");
	 		echo("<script>window.location = '../index.php?signup=success';</script>");
	 		mysqli_close($conn);
			exit(); 
		} else {
	 		echo("<script>alert('Signup Unsuccessful: Something went wrong, Please try again.')</script>");
	 		echo("<script>window.location = '../patient-signup.php?sign-up=error';</script>");
	 		mysqli_close($conn);
			exit(); 
		}
	} else {
 		echo("<script>alert('Signup Unsuccessful: Something went wrong, Please try again.')</script>");
 		echo("<script>window.location = '../patient-signup.php?sign-up=error';</script>");
 		mysqli_close($conn);
		exit(); 
	}
}else{
	header("Location: ../patient-signup.php?sign-up=error");
	mysqli_close($conn);
	exit(); 
}