<?php
$_SESSION['update_prescription_name'] = "";
$_SESSION['update_prescription_surname'] = "";
$_SESSION['update_prescription_id_num'] = "";
$_SESSION['update_prescription_gender'] = "";
$_SESSION['update_prescription_age'] = "";

$_SESSION['update_prescription_id'] = "";
$_SESSION['update_prescription_disease'] = "";
$_SESSION['update_prescription_medication'] = "";
$_SESSION['update_prescription_dosage'] = "";
$_SESSION['update_prescription_schedule'] = "";
$_SESSION['update_prescription_act_ingredients'] = "";
$_SESSION['update_prescription_quantity'] = "";
$_SESSION['update_prescription_repeats'] = "";
$_SESSION['update_prescription_status'] = "";
$_SESSION['update_prescription_instructions'] = "";
$_SESSION['update_prescription_date'] = "";

if(isset($_SESSION['update-prescription-id-num'])) {
	$_SESSION['update_prescription_name'] = $_SESSION['update-prescription-name'];
	$_SESSION['update_prescription_surname'] = $_SESSION['update-prescription-surname'];

	if($_SESSION['update-prescription-birth'] ==""){
         $_SESSION['update_prescription_age'] = "";
	} else {
		$_SESSION['update_prescription_age'] = date("Y") - substr($_SESSION['update-prescription-birth'], 0, 4);
	}
	
	$_SESSION['update_prescription_id_num'] = $_SESSION['update-prescription-id-num'];
	$_SESSION['update_prescription_gender'] = $_SESSION['update-prescription-gender'];
}

if(isset($_SESSION['update-prescription-id'])) {
	$_SESSION['update_prescription_id'] = $_SESSION['update-prescription-id'];
	$_SESSION['update_prescription_disease'] = $_SESSION['update-prescription-disease'];
	$_SESSION['update_prescription_medication'] = $_SESSION['update-prescription-medication'];
	$_SESSION['update_prescription_dosage'] = $_SESSION['update-prescription-dosage'];
	$_SESSION['update_prescription_schedule'] = $_SESSION['update-prescription-schedule'];
	$_SESSION['update_prescription_act_ingredients'] = $_SESSION['update-prescription-act-ingredients'];
	$_SESSION['update_prescription_quantity'] = $_SESSION['update-prescription-quantity'];
	$_SESSION['update_prescription_repeats'] = $_SESSION['update-prescription-repeats'];
	$_SESSION['update_prescription_status'] = $_SESSION['update-prescription-status'];
	$_SESSION['update_prescription_instructions'] = $_SESSION['update-prescription-instructions'];
	$_SESSION['update_prescription_date'] = $_SESSION['update-prescription-date'];
}
?>