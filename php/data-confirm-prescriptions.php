<?php
session_start();
include_once 'data-connection.php';

if (isset($_POST['btnSubmit'])) { 
    
    $sql = "UPDATE PRESCRIPTION SET STATUS = 'Prescribed'
    WHERE PATIENT_ID ='".$_SESSION['med_history_id_num']."' AND STATUS ='Unconfirmed'";
	if (mysqli_query($conn, $sql)) {
  		echo("<script>alert('Load Prescription Successful')</script>");
  		echo("<script>window.location = '../doctor-load-prescriptions.php?load-prescription=success';</script>");
 		mysqli_close($conn);
		exit(); 
	} else {
 		echo("<script>alert('Load Prescription Unsuccessful: Something went wrong, Please try again.')</script>");
 		echo("<script>window.location = '../doctor-load-prescriptions.php?load-prescription=error';</script>");
 		mysqli_close($conn);
		exit(); 
	}

} elseif (isset($_POST['btnClear'])) {
	$sql = "DELETE FROM PRESCRIPTION
    WHERE PATIENT_ID ='".$_SESSION['med_history_id_num']."' AND STATUS ='Unconfirmed'";
	if (mysqli_query($conn, $sql)) {
  		echo("<script>alert('Remove Prescription Successful')</script>");
  		echo("<script>window.location = '../doctor-load-prescriptions.php?remove-prescription=success';</script>");
 		mysqli_close($conn);
		exit(); 
	} else {
 		echo("<script>alert('Remove Prescription Unsuccessful: Something went wrong, Please try again.')</script>");
 		echo("<script>window.location = '../doctor-load-prescriptions.php?remove-prescription=error';</script>");
 		mysqli_close($conn);
		exit(); 
	}
}else{
	header("Location: ../index.php?load-prescription=error");
	session_unset();
	session_destroy();
	mysqli_close($conn);
	exit(); 
}