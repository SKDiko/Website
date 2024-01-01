<?php
$_SESSION['load_prescription_med_name'] = "";
$_SESSION['load_prescription_med_id'] = "";

if(isset($_SESSION['load-prescription-med-name'])) {
	$_SESSION['load_prescription_med_name'] = $_SESSION['load-prescription-med-name'];
	$_SESSION['load_prescription_med_id'] = $_SESSION['load-prescription-med-id'];
}
?>