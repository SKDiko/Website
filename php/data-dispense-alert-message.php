<?php
session_start();

if (isset($_GET['alert-reason']) && isset($_GET['test'])) {

	include_once 'data-connection.php'; 

	$message = mysqli_real_escape_string($conn, $_GET['alert-reason']);
	$pharm = mysqli_real_escape_string($conn, $_SESSION['dispense_pharm_reg_num']);
	$prescription_id = mysqli_real_escape_string($conn, $_SESSION['prescriptions_id']);

	$sql = "INSERT INTO ALERT_MESSAGE (MESSAGE, PHARMACIST_ID, PRESCRIPTION_ID)
	VALUES ('$message', '$pharm', '$prescription_id');";
	if (mysqli_query($conn, $sql)) {
  		echo("<script>alert('Capture Alert Reason Successful')</script>");
  		if($_GET['test'] == 1){
 			echo("<script>window.location = 'data-pharmacist-dispense-prescription.php?allergy_checked=yes&med_interaction_checked=no&med_contraindication_checked=no&dispense_days_checked=no';</script>");

 		} elseif ($_GET['test'] == 2) {
 			echo("<script>window.location = 'data-pharmacist-dispense-prescription.php?allergy_checked=yes&med_interaction_checked=yes&med_contraindication_checked=no&dispense_days_checked=no';</script>");

 		} elseif ($_GET['test'] == 3) {
 			echo("<script>window.location = 'data-pharmacist-dispense-prescription.php?allergy_checked=yes&med_interaction_checked=yes&med_contraindication_checked=yes&dispense_days_checked=no';</script>");

 		} elseif ($_GET['test'] == 4) {
 			echo("<script>window.location = 'data-pharmacist-dispense-prescription.php?allergy_checked=yes&med_interaction_checked=yes&med_contraindication_checked=yes&dispense_days_checked=yes';</script>");

 		} else {
 			echo("<script>alert('Capture Alert Reason Unsuccessful: Something went wrong, Please try again.')</script>");
 			echo("<script>window.location = '../pharmacist-view-prescriptions.php?capture-alert-reason=error';</script>");
 		}
 		mysqli_close($conn);
		exit();

	} else {
 		echo("<script>alert('Capture Alert Reason Unsuccessful: Something went wrong, Please try again.')</script>");
 		echo("<script>window.location = '../pharmacist-view-prescriptions.php?capture-alert-reason=error';</script>");
 		mysqli_close($conn);
		exit(); 
	}
    
}else{
	session_unset();
	session_destroy();
	header("Location: ../index.php?dispense-prescription=error");
	mysqli_close($conn);
	exit(); 
}