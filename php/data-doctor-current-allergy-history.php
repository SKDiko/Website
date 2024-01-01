<?php
session_start();

if (isset($_POST['btnSubmit'])) {

	include_once 'data-connection.php'; 

	$pat_id = mysqli_real_escape_string($conn, $_SESSION['current_allergy_id_num']);
	$doc_id = mysqli_real_escape_string($conn, $_SESSION['doc_reg_num']);
	$allergy_name = mysqli_real_escape_string($conn, $_POST['allergy_name']);
	$med_date = mysqli_real_escape_string($conn, $_POST['med_date']);

	if($pat_id == ""){
		echo("<script>alert('Capture Medical Allergy Unsuccessful: Patient personal details are empty.')</script>");
 		echo("<script>window.location = '../doctor-current-allergy-history.php?capture-allergy-history=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	$sql = "SELECT * FROM MED_HISTORY WHERE ALLERGY_ID ='".substr($allergy_name, 0, 7)."' AND PATIENT_ID ='$pat_id' AND MED_DATE ='$med_date'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		echo("<script>alert('Capture Medical Allergy Unsuccessful: Allergy: ".substr($allergy_name, 10).", for Patient: ".$pat_id." on the ".$med_date." is already captured.')</script>");
 		echo("<script>window.location = '../doctor-current-allergy-history.php?capture-allergy-history=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	$sql = "INSERT INTO MED_HISTORY (MED_DATE, DOCTOR_ID, ALLERGY_ID, PATIENT_ID)
	VALUES ('$med_date', '$doc_id', '".substr($allergy_name, 0, 7)."', '$pat_id');";
	if (mysqli_query($conn, $sql)) {
  		echo("<script>alert('Capture Allergy History Successful')</script>");
 		echo("<script>window.location = '../doctor-current-allergy-history.php?capture-allergy-history=success';</script>");
 		mysqli_close($conn);
		exit(); 
	} else {
 		echo("<script>alert('Capture Allergy History Unsuccessful: Please try again.')</script>");
 		echo("<script>window.location = '../doctor-current-allergy-history.php?capture-allergy-history=error';</script>");
 		mysqli_close($conn);
		exit(); 
	}

} elseif (isset($_POST['btnClear'])) {
	$_SESSION['current-allergy-id-num'] = "";
	echo("<script>window.location = '../doctor-current-allergy-history.php?clear-allergy-history=error';</script>");

}else{
	session_unset();
	session_destroy();
	header("Location: ../index.php.php?capture-allergy-history=error");
	mysqli_close($conn);
	exit(); 
}