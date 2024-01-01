<?php
$_SESSION['selected_disease'] = "";
if(isset($_GET['selected-disease']) == true) {
	$_SESSION['selected_disease'] = $_GET['selected-disease'];
}
?>