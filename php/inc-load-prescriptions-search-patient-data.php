<?php
$_SESSION['load_prescription_name'] = "";
$_SESSION['load_prescription_surname'] = "";
$_SESSION['load_prescription_id_num'] = "";
$_SESSION['load_prescription_gender'] = "";
$_SESSION['load_prescription_age'] = "";

if(isset($_SESSION['load-prescription-id-num'])) {
	$_SESSION['load_prescription_name'] = $_SESSION['load-prescription-name'];
	$_SESSION['load_prescription_surname'] = $_SESSION['load-prescription-surname'];

	if($_SESSION['load-prescription-birth'] ==""){
         $_SESSION['load_prescription_age'] = "";
	} else {
		$_SESSION['load_prescription_age'] = date("Y") - substr($_SESSION['load-prescription-birth'], 0, 4);
	}
	
	$_SESSION['load_prescription_id_num'] = $_SESSION['load-prescription-id-num'];
	$_SESSION['load_prescription_gender'] = $_SESSION['load-prescription-gender'];
}
?>