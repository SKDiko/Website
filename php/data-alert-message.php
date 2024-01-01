<?php
session_start();

if (isset($_GET['alert-reason']) && isset($_GET['test'])) {

	include_once 'data-connection.php'; 

	$message = mysqli_real_escape_string($conn, $_GET['alert-reason']);
	$doc_id = mysqli_real_escape_string($conn, $_SESSION['doc_reg_num']);
	$prescription_id = mysqli_real_escape_string($conn, $_SESSION['load_prescription_id']);

	$sql = "INSERT INTO ALERT_MESSAGE (MESSAGE, DOCTOR_ID, PRESCRIPTION_ID)
	VALUES ('$message', '$doc_id', '$prescription_id');";
	if (mysqli_query($conn, $sql)) {
  		echo("<script>alert('Capture Alert Reason Successful')</script>");
  		if($_GET['test'] == 1){
 			echo("<script>window.location = 'data-doctor-load-prescriptions.php?allergy_checked=yes&med_interaction_checked=no&med_contraindication_checked=no';</script>");
 		} elseif ($_GET['test'] == 2) {
 			echo("<script>window.location = 'data-doctor-load-prescriptions.php?allergy_checked=yes&med_interaction_checked=yes&med_contraindication_checked=no';</script>");
 		} else {
 			echo("<script>window.location = 'data-doctor-load-prescriptions.php?allergy_checked=yes&med_interaction_checked=yes&med_contraindication_checked=yes';</script>");
 		}
 		mysqli_close($conn);
		exit(); 
	} else {
 		echo("<script>alert('Capture Alert Reason Unsuccessful: Something went wrong, Please try again.')</script>");
 		echo("<script>window.location = '../doctor-load-prescriptions.php?capture-alert-reason=error';</script>");
 		mysqli_close($conn);
		exit(); 
	}
}else{
	session_unset();
	session_destroy();
	header("Location: ../index.php?load-prescription=error");
	mysqli_close($conn);
	exit(); 
}