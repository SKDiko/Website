<?php
$_SESSION['first_visit_name'] = "";
$_SESSION['first_visit_surname'] = "";
$_SESSION['first_visit_id_num'] = "";
$_SESSION['first_visit_gender'] = "";
$_SESSION['first_visit_street'] = "";
$_SESSION['first_visit_suburb'] = "";
$_SESSION['first_visit_town'] = "";
$_SESSION['first_visit_province'] = "";
$_SESSION['first_visit_code'] = "";
$_SESSION['first_visit_contact_num'] = "";
$_SESSION['first_visit_email'] = "";
$_SESSION['first_visit_age'] = "";

if(isset($_SESSION['first-visit-name']) == true && isset($_SESSION['first-visit-surname']) == true) {
	$_SESSION['first_visit_name'] = $_SESSION['first-visit-name'];
	$_SESSION['first_visit_surname'] = $_SESSION['first-visit-surname'];

	if($_SESSION['first-visit-birth'] ==""){
         $_SESSION['first_visit_age'] = "";
	} else {
		$_SESSION['first_visit_age'] = date("Y") - substr($_SESSION['first-visit-birth'], 0, 4);
	}
	
	$_SESSION['first_visit_id_num'] = $_SESSION['first-visit-id-num'];
	$_SESSION['first_visit_gender'] = $_SESSION['first-visit-gender'];
	$_SESSION['first_visit_street'] = $_SESSION['first-visit-street'];
	$_SESSION['first_visit_suburb'] = $_SESSION['first-visit-suburb'];
	$_SESSION['first_visit_town'] = $_SESSION['first-visit-town'];
	$_SESSION['first_visit_province'] = $_SESSION['first-visit-province'];
	$_SESSION['first_visit_code'] = $_SESSION['first-visit-code'];
	$_SESSION['first_visit_contact_num'] = $_SESSION['first-visit-contact-num'];
	$_SESSION['first_visit_email'] = $_SESSION['first-visit-email'];
}
?>