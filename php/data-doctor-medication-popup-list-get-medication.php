<?php
session_start();
if (isset($_POST['btnSelect'])) {
	$_SESSION['load-prescription-med-id'] = $_GET['med_id'];
	$_SESSION['load-prescription-med-name'] = $_GET['med_name'];

	echo("<script>window.location = '../doctor-load-prescriptions.php?medication-search=success';</script>");
}else{
	header("Location: ../dindex.php?medication-search=error");
	session_unset();
	session_destroy();
	mysqli_close($conn);
	exit();
}