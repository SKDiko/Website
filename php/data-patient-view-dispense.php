<?php

if (isset($_POST['btnView'])) {
	if($_GET['status'] != 'Dispensed'){
 		echo("<script>alert('View Dispense Unsuccessful: The prescription ".$_GET['med_name'].", have not yet been dispensed.')</script>");
 		echo("<script>window.location = '../patient-home.php?view-dispense=error';</script>");
		exit();
	} else {
		echo("<script>window.location = '../patient-view-dispensed-prescription.php?pre_id=".$_GET['prescription_id']."&med_name=".$_GET['med_name']."';</script>");
	}
	
} else {
	header("Location: ../index.php?update=error");
	session_unset();
	session_destroy();
	mysqli_close($conn);
	exit();
}