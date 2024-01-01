<?php
session_start();

if (isset($_POST['btnSubmit'])) {

	include_once 'data-connection.php'; 

	$pat_id = mysqli_real_escape_string($conn, $_SESSION['current_visit_id_num']);
	$doc_id = mysqli_real_escape_string($conn, $_SESSION['doc_reg_num']);
	$disease = mysqli_real_escape_string($conn, $_POST['disease_name']);
	$medication = mysqli_real_escape_string($conn, $_POST['medication']);
	$med_date = mysqli_real_escape_string($conn, $_POST['med_date']);

	if($pat_id == ""){
		echo("<script>alert('Capture Medical History Unsuccessful: Patient personal details are empty.')</script>");
 		echo("<script>window.location = '../doctor-current-medical-history.php?capture-medical-history=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	$sql = "SELECT * FROM MED_HISTORY WHERE DISEASE_ID ='".substr($disease, 0, 6)."' AND MED_ID ='".substr($medication, 0, 7)."' AND PATIENT_ID ='$pat_id' AND MED_DATE ='$med_date'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		echo("<script>alert('Capture Medical History Unsuccessful: Disease: ".substr($disease, 9).", and Medication: ".substr($medication, 9).", for Patient: ".$pat_id." on the ".$med_date." is already captured.')</script>");
 		echo("<script>window.location = '../doctor-current-medical-history.php?capture-medical-history=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	$sql = "INSERT INTO MED_HISTORY (MED_DATE, DOCTOR_ID, DISEASE_ID, MED_ID, PATIENT_ID)
	VALUES ('$med_date', '$doc_id', '".substr($disease, 0, 6)."', '".substr($medication, 0, 7)."', '$pat_id');";
	if (mysqli_query($conn, $sql)) {		
  		echo("<script>alert('Capture Medical History Successful')</script>");
 		echo("<script>window.location = '../doctor-current-medical-history.php?capture-medical-history=success';</script>");
 		mysqli_close($conn);
		exit(); 
	} else {
 		echo("<script>alert('Capture Medical History Unsuccessful: Please try again.')</script>");
 		echo("<script>window.location = '../doctor-current-medical-history.php?capture-medical-history=error';</script>");
 		mysqli_close($conn);
		exit(); 
	}
} elseif (isset($_POST['btnClear'])) {
	$_SESSION['current-visit-id-num'] = "";
	echo("<script>window.location = '../doctor-current-medical-history.php?clear-medical-history=success';</script>");
}else{
	session_unset();
	session_destroy();
	header("Location: ../index.php.php?capture-medical-history=error");
	mysqli_close($conn);
	exit(); 
}