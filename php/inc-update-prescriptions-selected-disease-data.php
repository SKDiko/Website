<?php
$_SESSION['selected_disease'] = $_SESSION['update_prescription_disease'];
if(isset($_GET['selected-disease']) == true) {
	$_SESSION['selected_disease'] = $_GET['selected-disease'];
	$_SESSION['update_prescription_medication'] = "";
}
?>