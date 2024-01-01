<?php
$_SESSION['dispense_pat_name'] = "";
$_SESSION['dispense_pat_surname'] = "";
$_SESSION['dispense_pat_id_num'] = "";
$_SESSION['dispense_pat_gender'] = "";
$_SESSION['dispense_pat_age'] = "";

$_SESSION['dispense_doc_surname'] = "";
$_SESSION['dispense_doc_name'] = "";
$_SESSION['dispense_doc_contact_num'] = "";
$_SESSION['dispense_doc_email'] = "";
$_SESSION['dispense_doc_medical_practice'] = "";
$_SESSION['dispense_prescription_id'] = "";
$_SESSION['dispense_prescription_date'] = "";
$_SESSION['dispense_prescription_disease'] = "";
$_SESSION['dispense_prescription_medication'] = "";
$_SESSION['dispense_prescription_dosage'] = "";
$_SESSION['dispense_prescription_schedule'] = "";
$_SESSION['dispense_prescription_act_ingredients'] = "";
$_SESSION['dispense_prescription_quantity'] = "";
$_SESSION['dispense_prescription_original_repeats'] = "";
$_SESSION['dispense_prescription_current_repeats'] = "";
$_SESSION['dispense_prescription_status'] = "";
$_SESSION['dispense_prescription_instructions'] = "";
$_SESSION['dispense_prescription_latest_date'] = "";

if(isset($_SESSION['dispense-pat-id-num'])) {
	$_SESSION['dispense_pat_name'] = $_SESSION['dispense-pat-name'];
	$_SESSION['dispense_pat_surname'] = $_SESSION['dispense-pat-surname'];

	if($_SESSION['dispense-pat-birth'] ==""){
         $_SESSION['dispense_pat_age'] = "";
	} else {
		$_SESSION['dispense_pat_age'] = date("Y") - substr($_SESSION['dispense-pat-birth'], 0, 4);
	}
	
	$_SESSION['dispense_pat_id_num'] = $_SESSION['dispense-pat-id-num'];
	$_SESSION['dispense_pat_gender'] = $_SESSION['dispense-pat-gender'];
}

if(isset($_SESSION['dispense-prescription-id'])) {
	$_SESSION['dispense_doc_surname'] = $_SESSION['dispense-doc-surname'];
	$_SESSION['dispense_doc_name'] = $_SESSION['dispense-doc-name'];
	$_SESSION['dispense_doc_contact_num'] = $_SESSION['dispense-doc-contact-num'];
	$_SESSION['dispense_doc_email'] = $_SESSION['dispense-doc-email'];
	$_SESSION['dispense_doc_medical_practice'] = $_SESSION['dispense-doc-medical-practice'];
	$_SESSION['dispense_prescription_id'] = $_SESSION['dispense-prescription-id'];
	$_SESSION['dispense_prescription_date'] = $_SESSION['dispense-prescription-date'];
	$_SESSION['dispense_prescription_disease'] = $_SESSION['dispense-prescription-disease'];
	$_SESSION['dispense_prescription_medication'] = $_SESSION['dispense-prescription-medication'];
	$_SESSION['dispense_prescription_dosage'] = $_SESSION['dispense-prescription-dosage'];
	$_SESSION['dispense_prescription_schedule'] = $_SESSION['dispense-prescription-schedule'];
	$_SESSION['dispense_prescription_act_ingredients'] = $_SESSION['dispense-prescription-act-ingredients'];
	$_SESSION['dispense_prescription_quantity'] = $_SESSION['dispense-prescription-quantity'];
	$_SESSION['dispense_prescription_original_repeats'] = $_SESSION['dispense-prescription-original-repeats'];
	$_SESSION['dispense_prescription_current_repeats'] = $_SESSION['dispense-prescription-current-repeats'];
	$_SESSION['dispense_prescription_status'] = $_SESSION['dispense-prescription-status'];
	$_SESSION['dispense_prescription_instructions'] = $_SESSION['dispense-prescription-instructions'];
	$_SESSION['dispense_prescription_latest_date'] = $_SESSION['dispense-prescription-latest-date'];
}
?>