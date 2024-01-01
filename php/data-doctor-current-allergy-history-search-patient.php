<?php
session_start();
if (isset($_POST['btnSearch'])) {
	include 'data-connection.php'; 
	$userName = mysqli_real_escape_string($conn, $_POST['id_num']);

	$sql = "SELECT * FROM MED_HISTORY WHERE PATIENT_ID ='$userName' AND NOT ALLERGY_ID ='NULL'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck < 1){
		$_SESSION['current-allergy-id-num'] = "";
		echo("<script>alert('Search Unsuccessful: Allergy History of Patient ID ".$userName." is not found.')</script>");
		echo("<script>window.location = '../doctor-current-allergy-history.php?patient-search=error';</script>");
 		mysqli_close($conn);
		exit();
	}else{
		if($row = mysqli_fetch_assoc($result)){
			$_SESSION['current-allergy-id-num'] = $row['PATIENT_ID'];
			header("Location: ../doctor-current-allergy-history.php?patient-search=success");
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