<?php
session_start();
if (isset($_POST['btnSearch'])) {
	include 'data-connection.php'; 
	$userName = mysqli_real_escape_string($conn, $_POST['id_num']);

	$sql = "SELECT * FROM PATIENT WHERE ID_NUMBER ='$userName'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck < 1){
		$_SESSION['load-prescription-id-num'] = "";
		$_SESSION['load-prescription-name'] = "";
		$_SESSION['load-prescription-surname'] = "";
		$_SESSION['load-prescription-birth'] = "";
		$_SESSION['load-prescription-gender'] = "";

		echo("<script>alert('Search Unsuccessful: Patient ID ".$userName." not found, Please try again.')</script>");
		echo("<script>window.location = '../doctor-load-prescriptions.php?patient-search=error';</script>");
 		mysqli_close($conn);
		exit();
	}else{
		if($row = mysqli_fetch_assoc($result)){
			$_SESSION['load-prescription-id-num'] = $row['ID_NUMBER'];
			$_SESSION['load-prescription-name'] = $row['NAME'];
			$_SESSION['load-prescription-surname'] = $row['SURNAME'];
			$_SESSION['load-prescription-birth'] = $row['DATE_OF_BIRTH'];
			$_SESSION['load-prescription-gender'] = $row['GENDER'];

			header("Location: ../doctor-load-prescriptions.php?patient-search=success");
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