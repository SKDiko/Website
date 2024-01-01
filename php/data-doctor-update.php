<?php
session_start();

if (isset($_POST['btnSubmit'])) {
	//Get database connection
	include_once 'data-connection.php'; 
	//Convert data to string before enters database
	$user_name = $_SESSION['doc_reg_num'];
	$practice_num = mysqli_real_escape_string($conn, $_POST['practice_name']);
	$qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
	$contact_num = mysqli_real_escape_string($conn, $_POST['contact_num']);
	$verify_email = mysqli_real_escape_string($conn, $_POST['verify_email']);
	$confirm_pswd = mysqli_real_escape_string($conn, $_POST['confirm_pswd']);
	$current_pswd = mysqli_real_escape_string($conn, $_POST['current_pswd']);
    
    if ($current_pswd == $_SESSION['doc_password']) {
    	$sql = "SELECT * FROM DOCTOR WHERE EMAIL ='$verify_email' AND NOT REGISTRATION_NUM = '$user_name'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
			echo("<script>alert('Update Unsuccessful: Email address ".$verify_email." is already taken by another doctor.')</script>");
		 	echo("<script>window.location = '../doctor-account.php?update=error';</script>");
		 	mysqli_close($conn);
			exit();
		}

    	$sql = "UPDATE DOCTOR SET QUALIFICATION = '$qualification', PRACTICE_NUM = '$practice_num', CONTACT_NUMBER = '$contact_num', EMAIL = '$verify_email', PASSWORD = '$confirm_pswd' WHERE REGISTRATION_NUM = '$user_name';";
		if (mysqli_query($conn, $sql)) {
  			echo("<script>alert('Doctor Update Successful')</script>");
  			echo("<script>window.location = '../index.php?update=success';</script>");
  			session_unset();
			session_destroy();
 			mysqli_close($conn);
			exit(); 
		} else {
 			echo("<script>alert('Update Unsuccessful: Something went wrong, Please try again.')</script>");
 			echo("<script>window.location = '../doctor-account.php?update=error';</script>");
 			mysqli_close($conn);
			exit(); 
		}

	}else{
		echo("<script>alert('Update Unsuccessful: The password you typed is incorrect.')</script>");
 		echo("<script>window.location = '../doctor-account.php?update=error';</script>");
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