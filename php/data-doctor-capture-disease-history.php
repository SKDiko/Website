<?php
session_start();

if (isset($_POST['btnSubmit'])) {

	include_once 'data-connection.php'; 

	$pat_id = mysqli_real_escape_string($conn, $_SESSION['med_history_id_num']);
	$doc_id = mysqli_real_escape_string($conn, $_SESSION['doc_reg_num']);
	$disease = mysqli_real_escape_string($conn, $_POST['disease_name']);
	$med_date = mysqli_real_escape_string($conn, $_POST['med_date']);

    
	if($pat_id == ""){
		echo("<script>alert('Capture Disease History Unsuccessful: Patient personal details are empty.')</script>");
 		echo("<script>window.location = '../doctor-home.php?capture-disease-history=error';</script>");
 		mysqli_close($conn);
		exit();
	}
    
	$sql = "SELECT * FROM MED_HISTORY WHERE DISEASE_ID ='".substr($disease, 0, 6)."' AND PATIENT_ID ='$pat_id' AND MED_DATE ='$med_date'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		echo("<script>alert('Capture Disease History Unsuccessful: Disease: ".substr($disease, 9).", for Patient: ".$pat_id." on the ".$med_date." is already captured.')</script>");
 		echo("<script>window.location = '../doctor-capture-disease-history.php?capture-disease-history=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	$sql = "INSERT INTO MED_HISTORY (MED_DATE, DOCTOR_ID, DISEASE_ID, PATIENT_ID)
	VALUES ('$med_date', '$doc_id', '".substr($disease, 0, 6)."', '$pat_id');";
	if (mysqli_query($conn, $sql)) {		
  		echo("<script>alert('Capture Disease History Successful')</script>");
 		echo("<script>window.location = '../doctor-capture-disease-history.php?capture-disease-history=success';</script>");
 		mysqli_close($conn);
		exit(); 
	} else {
 		echo("<script>alert('Capture Disease History Unsuccessful: Please try again.')</script>");
 		echo("<script>window.location = '../doctor-capture-disease-history.php?capture-disease-history=error';</script>");
 		mysqli_close($conn);
		exit(); 
	}
}else{
	session_unset();
	session_destroy();
	header("Location: ../index.php?capture-disease-history=error");
	mysqli_close($conn);
	exit(); 
}