<?php
session_start();
if (isset($_POST['btnSearch'])) {
	include 'data-connection.php'; 
	$med_name = mysqli_real_escape_string($conn, $_POST['medication']);

	$sql = "SELECT * FROM MEDICATION WHERE NAME ='$med_name'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck < 1){
		$_SESSION['load-prescription-med-name'] = "";
		$_SESSION['load-prescription-med-id'] = "";

		echo("<script>alert('Search Unsuccessful: Medication name: ".$med_name." not found, Please try again.')</script>");
		echo("<script>window.location = '../doctor-load-prescriptions.php?medication-search=error';</script>");
 		mysqli_close($conn);
		exit();
	}else{
		echo("<script>window.location = '../doctor-medication-popup-list.php?med_name=".$med_name."';</script>");
 		mysqli_close($conn);
		exit();
	}
}else{
	header("Location: ../index.php?medication-search=error");
	session_unset();
	session_destroy();
	mysqli_close($conn);
	exit();
}