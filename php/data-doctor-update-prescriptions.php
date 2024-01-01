<?php
session_start();

if ((isset($_POST['btnUpdate']))) {

	include_once 'data-connection.php';

	$_SESSION['updates_prescription_id'] = mysqli_real_escape_string($conn, $_GET['prescription_id']);
	$_SESSION['updates_medication'] = mysqli_real_escape_string($conn, $_POST['medication']);
	$_SESSION['updates_med_id'] = substr($_SESSION['updates_medication'], 0, 7);
	$_SESSION['updates_med_name'] = substr($_SESSION['updates_medication'], 10);
	$_SESSION['updates_quantity'] = mysqli_real_escape_string($conn, $_POST['quantity']);
	$_SESSION['updates_repeats'] = mysqli_real_escape_string($conn, $_POST['repeats']);
	$_SESSION['updates_instructions'] = mysqli_real_escape_string($conn, $_POST['instructions']);
	$_SESSION['updates_prescription_date'] = mysqli_real_escape_string($conn, $_POST['prescription_date']);
	$_SESSION['updates_pat_id'] = mysqli_real_escape_string($conn, $_SESSION['med_history_id_num']);
	$_SESSION['updates_doc_id'] = mysqli_real_escape_string($conn, $_SESSION['doc_reg_num']); 
    
	$sql = "UPDATE PRESCRIPTION SET 
	MED_ID = '".$_SESSION['updates_med_id']."',
	QUANTITY = '".$_SESSION['updates_quantity']."',
	ORIGINAL_REPEATS = '".$_SESSION['updates_repeats']."',
	CURRENT_REPEATS = '".$_SESSION['updates_repeats']."',
	STATUS = 'Prescribed',
	INSTRUCTIONS = '".$_SESSION['updates_instructions']."',
	PRESCRIPTION_DATE = '".$_SESSION['updates_prescription_date']."',
	DOCTOR_ID = '".$_SESSION['updates_doc_id']."',
	PATIENT_ID = '".$_SESSION['updates_pat_id']."'
	WHERE PRESCRIPTION_ID = '".$_SESSION['updates_prescription_id']."';";
	 
	if (mysqli_query($conn, $sql)) {
		echo("<script>alert('Update Prescription Successful')</script>");
	 	echo("<script>window.location = '../doctor-update-prescriptions.php?update-prescription=success';</script>");
	 	mysqli_close($conn);
		exit();
		
	} else {
 		echo("<script>alert('Upadate Prescription Unsuccessful: Something went wrong, please try again.')</script>");
 		echo("<script>window.location = '../doctor-update-prescriptions.php?update-prescription=error';</script>");
 		mysqli_close($conn);
		exit(); 
	}

}else{
	session_unset();
	session_destroy();
	header("Location: ../index.php?update-prescription=error");
	mysqli_close($conn);
	exit(); 
}