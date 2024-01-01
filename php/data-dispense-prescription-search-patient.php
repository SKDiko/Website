<?php
session_start();
if (isset($_POST['btnSearch'])) {
	include 'data-connection.php'; 
	$userName = mysqli_real_escape_string($conn, $_POST['id_num']);

	$sql = "SELECT * FROM PATIENT WHERE ID_NUMBER ='$userName'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck < 1){
		$_SESSION['dispense-pat-id-num'] = "";
		$_SESSION['dispense-pat-name'] = "";
		$_SESSION['dispense-pat-surname'] = "";
		$_SESSION['dispense-pat-birth'] = "";
		$_SESSION['dispense-pat-gender'] = "";
		$_SESSION['dispense-doc-surname'] = "";
		$_SESSION['dispense-doc-name'] = "";
		$_SESSION['dispense-doc-contact-num'] = "";
		$_SESSION['dispense-doc-email'] = "";
		$_SESSION['dispense-doc-medical-practice'] = "";
		$_SESSION['dispense-prescription-id'] = "";
		$_SESSION['dispense-prescription-date'] = "";
		$_SESSION['dispense-prescription-disease'] = "";
		$_SESSION['dispense-prescription-medication'] = "";
		$_SESSION['dispense-prescription-dosage'] = "";
		$_SESSION['dispense-prescription-schedule'] = "";
		$_SESSION['dispense-prescription-act-ingredients'] = "";
		$_SESSION['dispense-prescription-quantity'] = "";
		$_SESSION['dispense-prescription-original-repeats'] = "";
		$_SESSION['dispense-prescription-current-repeats'] = "";
		$_SESSION['dispense-prescription-status'] = "";
		$_SESSION['dispense-prescription-instructions'] = "";
		$_SESSION['dispense-prescription-latest-date'] = "";

		echo("<script>alert('Search Unsuccessful: Patient ID ".$userName." not found, Please try again.')</script>");
		echo("<script>window.location = '../pharmacist-dispense-prescription.php?patient-search=error';</script>");
 		mysqli_close($conn);
		exit();
	}else{
		if($row = mysqli_fetch_assoc($result)){
			$_SESSION['dispense-pat-id-num'] = $row['ID_NUMBER'];
			$_SESSION['dispense-pat-name'] = $row['NAME'];
			$_SESSION['dispense-pat-surname'] = $row['SURNAME'];
			$_SESSION['dispense-pat-birth'] = $row['DATE_OF_BIRTH'];
			$_SESSION['dispense-pat-gender'] = $row['GENDER'];
			$_SESSION['dispense-doc-surname'] = "";
			$_SESSION['dispense-doc-name'] = "";
			$_SESSION['dispense-doc-contact-num'] = "";
			$_SESSION['dispense-doc-email'] = "";
			$_SESSION['dispense-doc-medical-practice'] = "";
			$_SESSION['dispense-prescription-id'] = "";
			$_SESSION['dispense-prescription-date'] = "";
			$_SESSION['dispense-prescription-disease'] = "";
			$_SESSION['dispense-prescription-medication'] = "";
			$_SESSION['dispense-prescription-dosage'] = "";
			$_SESSION['dispense-prescription-schedule'] = "";
			$_SESSION['dispense-prescription-act-ingredients'] = "";
			$_SESSION['dispense-prescription-quantity'] = "";
			$_SESSION['dispense-prescription-original-repeats'] = "";
			$_SESSION['dispense-prescription-current-repeats'] = "";
			$_SESSION['dispense-prescription-status'] = "";
			$_SESSION['dispense-prescription-instructions'] = "";
			$_SESSION['dispense-prescription-latest-date'] = "";

			header("Location: ../pharmacist-dispense-prescription.php?patient-search=success");
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