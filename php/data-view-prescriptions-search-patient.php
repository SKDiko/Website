<?php
session_start();
if (isset($_POST['btnSearch'])) {
	include 'data-connection.php'; 
	$userName = mysqli_real_escape_string($conn, $_POST['id_num']);

	$sql = "SELECT * FROM PATIENT WHERE ID_NUMBER ='$userName'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck < 1){
		$_SESSION['view-prescriptions-pat-id-num'] = "";

		echo("<script>alert('Search Unsuccessful: Patient ID ".$userName." not found, Please try again.')</script>");
		echo("<script>window.location = '../pharmacist-view-prescriptions.php?patient-search=error';</script>");
 		mysqli_close($conn);
		exit();
	}else{
		if($row = mysqli_fetch_assoc($result)){
			$_SESSION['view-prescriptions-pat-id-num'] = $row['ID_NUMBER'];

			header("Location: ../pharmacist-view-prescriptions.php?patient-search=success");
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