<?php
session_start();
if (isset($_POST['btnSearch'])) {
	include 'data-connection.php'; 
	$userName = mysqli_real_escape_string($conn, $_POST['id_num']);

	$sql = "SELECT * FROM MED_HISTORY WHERE PATIENT_ID ='$userName' AND NOT DISEASE_ID ='NULL' AND NOT MED_ID ='NULL'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck < 1){
		$_SESSION['current-visit-id-num'] = "";
		echo("<script>alert('Search Unsuccessful: Medical History of Patient ID ".$userName." is not found.')</script>");
		echo("<script>window.location = '../doctor-current-medical-history.php?patient-search=error';</script>");
 		mysqli_close($conn);
		exit();
	}else{
		if($row = mysqli_fetch_assoc($result)){
			$_SESSION['current-visit-id-num'] = $row['PATIENT_ID'];
			header("Location: ../doctor-current-medical-history.php?patient-search=success");
			mysqli_close($conn);
			exit();
		}
	}
}else{
	header("Location: ../index.php.php?patient-search=error");
	session_unset();
	session_destroy();
	mysqli_close($conn);
	exit();
}