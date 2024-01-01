<?php
session_start();

if (isset($_POST['btnSubmit'])) {
	//Get database connection
	include_once 'data-connection.php'; 
	//Convert data to string before enters database
	$id_num = $_SESSION['pat_id_num'];
	$address_id = $_SESSION['pat_address'];
	$line1 = mysqli_real_escape_string($conn, $_POST['line1']);
	$line2 = mysqli_real_escape_string($conn, $_POST['line2']);
	$suburb = mysqli_real_escape_string($conn, $_POST['suburb']);
	$town = mysqli_real_escape_string($conn, $_POST['town']);
	$province = mysqli_real_escape_string($conn, $_POST['province']);
	$code = mysqli_real_escape_string($conn, $_POST['code']);
	$contact_num = mysqli_real_escape_string($conn, $_POST['contact_num']);
	$verify_email = mysqli_real_escape_string($conn, $_POST['verify_email']);
	$confirm_pswd = mysqli_real_escape_string($conn, $_POST['confirm_pswd']);
	$current_pswd = mysqli_real_escape_string($conn, $_POST['current_pswd']);
    
    if ($current_pswd == $_SESSION['pat_password']) {
    	$sql = "SELECT * FROM PATIENT WHERE EMAIL ='$verify_email' AND NOT ID_NUMBER = '$id_num'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
			echo("<script>alert('Update Unsuccessful: Email address ".$verify_email." is already taken by another patient.')</script>");
		 	echo("<script>window.location = '../patient-home.php?update=error';</script>");
		 	mysqli_close($conn);
			exit();
		}

    	$sql = "UPDATE PATIENT SET CONTACT_NUMBER = '$contact_num', EMAIL = '$verify_email', PASSWORD = '$confirm_pswd' WHERE ID_NUMBER = '$id_num';";
		if (mysqli_query($conn, $sql)) {

  			$sql1 = "UPDATE ADDRESS SET LINE1 = '$line1', LINE2 = '$line2', SUBURB = '$suburb', TOWN = '$town', PROVINCE = '$province', CODE = '$code' WHERE ADDRESS_ID = '$address_id';";
			if (mysqli_query($conn, $sql1)) {
	  			echo("<script>alert('Patient Update Successful')</script>");
	  			echo("<script>window.location = '../index.php?update=success';</script>");
	  			session_unset();
				session_destroy();
	 			mysqli_close($conn);
				exit(); 
			} else {
	 			echo("<script>alert('Update Unsuccessful: Something went wrong, Please try again.')</script>");
	 			echo("<script>window.location = '../patient-home.php?update=error';</script>");
	 			mysqli_close($conn);
				exit(); 
			}

		} else {
 			echo("<script>alert('Update Unsuccessful: Something went wrong, Please try again.')</script>");
 			echo("<script>window.location = '../patient-home.php?update=error';</script>");
 			mysqli_close($conn);
			exit(); 
		}
	}else{
		echo("<script>alert('Update Unsuccessful: The password you typed is incorrect.')</script>");
 		echo("<script>window.location = '../patient-home.php?update=error';</script>");
 		mysqli_close($conn);
		exit(); 
	}
}else{
	header("Location: ../index.php?update=error");
	session_unset();
	session_destroy();
	mysqli_close($conn);
	exit(); 
}