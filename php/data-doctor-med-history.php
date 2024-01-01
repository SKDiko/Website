<?php
session_start();

if (isset($_POST['btnNext'])) {
	if ($_SESSION['med_history_id_num'] == "") {
		echo("<script>alert('Capture Medical History Unsuccessful: Patient personal details are empty.')</script>");
		echo("<script>window.location = '../doctor-home.php?capture-medical-history=error';</script>");
		exit();
	} else {
		echo("<script>window.location = '../doctor-capture-disease-history.php';</script>");
		exit();
	}

} else if (isset($_POST['btnClear'])) {
	$_SESSION['med-history-name'] = "";
	$_SESSION['med-history-surname'] = "";
	$_SESSION['med-history-id-num'] = "";
	$_SESSION['med-history-gender'] = "";
	$_SESSION['med-history-street'] = "";
	$_SESSION['med-history-suburb'] = "";
	$_SESSION['med-history-town'] = "";
	$_SESSION['med-history-province'] = "";
	$_SESSION['med-history-code'] = "";
	$_SESSION['med-history-contact-num'] = "";
	$_SESSION['med-history-email'] = "";
	$_SESSION['med-history-birth'] = "";

	echo("<script>window.location = '../doctor-home.php?clear-medical-history=success';</script>");
	exit();
}else{
	header("Location: ../index.php?capture-medical-history=error");
	session_unset();
	session_destroy();
	mysqli_close($conn);
	exit();
}