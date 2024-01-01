<?php
$_SESSION['first_allergy_name'] = "";
$_SESSION['first_allergy_surname'] = "";
$_SESSION['first_allergy_id_num'] = "";
$_SESSION['first_allergy_gender'] = "";
$_SESSION['first_allergy_street'] = "";
$_SESSION['first_allergy_suburb'] = "";
$_SESSION['first_allergy_town'] = "";
$_SESSION['first_allergy_province'] = "";
$_SESSION['first_allergy_code'] = "";
$_SESSION['first_allergy_contact_num'] = "";
$_SESSION['first_allergy_email'] = "";
$_SESSION['first_allergy_age'] = "";

if(isset($_SESSION['first-allergy-name']) == true && isset($_SESSION['first-allergy-surname']) == true) {
	$_SESSION['first_allergy_name'] = $_SESSION['first-allergy-name'];
	$_SESSION['first_allergy_surname'] = $_SESSION['first-allergy-surname'];

	if($_SESSION['first-allergy-birth'] ==""){
         $_SESSION['first_allergy_age'] = "";
	} else {
		$_SESSION['first_allergy_age'] = date("Y") - substr($_SESSION['first-allergy-birth'], 0, 4);
	}
	
	$_SESSION['first_allergy_id_num'] = $_SESSION['first-allergy-id-num'];
	$_SESSION['first_allergy_gender'] = $_SESSION['first-allergy-gender'];
	$_SESSION['first_allergy_street'] = $_SESSION['first-allergy-street'];
	$_SESSION['first_allergy_suburb'] = $_SESSION['first-allergy-suburb'];
	$_SESSION['first_allergy_town'] = $_SESSION['first-allergy-town'];
	$_SESSION['first_allergy_province'] = $_SESSION['first-allergy-province'];
	$_SESSION['first_allergy_code'] = $_SESSION['first-allergy-code'];
	$_SESSION['first_allergy_contact_num'] = $_SESSION['first-allergy-contact-num'];
	$_SESSION['first_allergy_email'] = $_SESSION['first-allergy-email'];
}
?>