<?php
$_SESSION['med_history_name'] = "";
$_SESSION['med_history_surname'] = "";
$_SESSION['med_history_id_num'] = "";
$_SESSION['med_history_gender'] = "";
$_SESSION['med_history_line1'] = "";
$_SESSION['med_history_line2'] = "";
$_SESSION['med_history_suburb'] = "";
$_SESSION['med_history_town'] = "";
$_SESSION['med_history_province'] = "";
$_SESSION['med_history_code'] = "";
$_SESSION['med_history_contact_num'] = "";
$_SESSION['med_history_email'] = "";
$_SESSION['med_history_age'] = "";

if(isset($_SESSION['med-history-name']) == true && isset($_SESSION['med-history-surname']) == true) {
	$_SESSION['med_history_name'] = $_SESSION['med-history-name'];
	$_SESSION['med_history_surname'] = $_SESSION['med-history-surname'];

	if($_SESSION['med-history-birth'] ==""){
         $_SESSION['med_history_age'] = "";
	} else {
		$_SESSION['med_history_age'] = date("Y") - substr($_SESSION['med-history-birth'], 0, 4);
	}
	
	$_SESSION['med_history_id_num'] = $_SESSION['med-history-id-num'];
	$_SESSION['med_history_gender'] = $_SESSION['med-history-gender'];
	$_SESSION['med_history_line1'] = $_SESSION['med-history-line1'];
	$_SESSION['med_history_line2'] = $_SESSION['med-history-line2'];
	$_SESSION['med_history_suburb'] = $_SESSION['med-history-suburb'];
	$_SESSION['med_history_town'] = $_SESSION['med-history-town'];
	$_SESSION['med_history_province'] = $_SESSION['med-history-province'];
	$_SESSION['med_history_code'] = $_SESSION['med-history-code'];
	$_SESSION['med_history_contact_num'] = $_SESSION['med-history-contact-num'];
	$_SESSION['med_history_email'] = $_SESSION['med-history-email'];
}
?>