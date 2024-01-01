<?php
session_start();

if (isset($_GET['dispense_days_checked']) && !(isset($_POST['btnReject']))) {

	include_once 'data-connection.php';

	if($_SESSION['dispense_pat_id_num'] == ""){
 		echo("<script>alert('Dispense Prescription Unsuccessful: Patient personal details are empty.')</script>");
 		echo("<script>window.location = '../pharmacist-dispense-prescription.php?dispense-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	if($_SESSION['dispense_prescription_id'] == ""){
 		echo("<script>alert('Dispense Prescription Unsuccessful: Patient Prescription details are empty.')</script>");
 		echo("<script>window.location = '../pharmacist-dispense-prescription.php?dispense-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	if($_SESSION['dispense_prescription_current_repeats'] <= 0){
 		echo("<script>alert('Dispense Prescription Unsuccessful: There are no current repeats left.')</script>");
 		echo("<script>window.location = '../pharmacist-dispense-prescription.php?dispense-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	if($_SESSION['dispense_prescription_status'] == 'Rejected'){
 		echo("<script>alert('Dispense Prescription Unsuccessful: The prescription is rejected.')</script>");
 		echo("<script>window.location = '../pharmacist-dispense-prescription.php?dispense-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	if($_GET['dispense_days_checked'] == 'no') {
	    $_SESSION['dispense_id'] = substr(md5(uniqid('', true)), 0, 10);
	    $_SESSION['dispense_date'] = mysqli_real_escape_string($conn, $_POST['dispense_date']);
	    $_SESSION['prescriptions_id'] = mysqli_real_escape_string($conn, $_SESSION['dispense_prescription_id']);
	    $_SESSION['dispense_medical_practice'] = mysqli_real_escape_string($conn, $_SESSION['dispense_doc_medical_practice']);
	    $_SESSION['dispense_pharm_reg_num'] = mysqli_real_escape_string($conn, $_SESSION['pharm_reg_num']);
	    $_SESSION['dispense_pharmacy_id'] = mysqli_real_escape_string($conn, $_SESSION['pharm_pharmacy_id']);
	    $_SESSION['dispense_patient_id_num'] = mysqli_real_escape_string($conn, $_SESSION['dispense_pat_id_num']);
	    $_SESSION['dispense_current_repeats'] = mysqli_real_escape_string($conn, ($_SESSION['dispense_prescription_current_repeats'] - 1));
	    $_SESSION['dispensing_date'] = date('Y-m-d', strtotime($_SESSION['dispense_prescription_latest_date']. ' + 20 days'));
    }

    $sql = "SELECT * FROM DISPENSE_PRESCRIPTION WHERE DISPENSE_ID ='".$_SESSION['dispense_id']."'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		echo("<script>alert('Dispense Prescription Unsuccessful: Something went wrong, please try again.')</script>");
 		echo("<script>window.location = '../pharmacist-dispense-prescription.php?dispense-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}
	
	if($_GET['dispense_days_checked'] == 'no' && $_SESSION['dispense_prescription_latest_date'] != "None") {

		if($_SESSION['dispense_date'] <= $_SESSION['dispense_prescription_latest_date']){
	 		echo("<script>alert('Dispense Prescription Unsuccessful: Current Dispense Date: ".$_SESSION['dispense_date']." have to be greater than Last Dispense Date: ".$_SESSION['dispense_prescription_latest_date'].".')</script>");
	 		echo("<script>window.location = '../pharmacist-dispense-prescription.php?dispense-prescription=error';</script>");
	 		mysqli_close($conn);
			exit();
		}

		if ($_SESSION['dispense_date'] < $_SESSION['dispensing_date']) {
			echo "
			<script>
				if (confirm('Repeat Prescription Alert: 20 days must pass before the prescription can be dispensed again [Next dispense date: ".$_SESSION['dispensing_date']."]. Do you want to ignore this alert?')) {
					var reason;
					let dialog_box = prompt('Please provide a reason for ignoring the alert:');
					if (dialog_box == null || dialog_box.trim() == '') {
						alert('Dispense Prescription Unsuccessful: Please provide a reason for ignoring the alert.')
						  	window.location = '../pharmacist-dispense-prescription.php?dispense-prescription=error'
					} else {
						window.location = 'data-dispense-alert-message.php?alert-reason=' + dialog_box +'&test=1';
					}
				} else {
				   alert('Dispense Prescription Unsuccessful: The prescription must be dispensed again on the ".$_SESSION['dispensing_date'].".')
					window.location = '../pharmacist-dispense-prescription.php?dispense-prescription=error'
				}	
				</script>";
				mysqli_close($conn);
				exit();
		}
	}

	$sql1 = "INSERT INTO DISPENSE_PRESCRIPTION (DISPENSE_ID, DISPENSE_DATE, PHARMACY_ID, PHARMACIST_ID, PATIENT_ID, PRESCRIPTION_ID)
	VALUES (
	 '".$_SESSION['dispense_id']."',
	 '".$_SESSION['dispense_date']."',
	 '".$_SESSION['dispense_pharmacy_id']."',
	 '".$_SESSION['dispense_pharm_reg_num']."',
	 '".$_SESSION['dispense_patient_id_num']."',
	 '".$_SESSION['prescriptions_id']."'
	);";
	if (mysqli_query($conn, $sql1)) {
		
		$sql2 = "UPDATE PRESCRIPTION SET CURRENT_REPEATS = '".$_SESSION['dispense_current_repeats']."', STATUS = 'Dispensed' WHERE PRESCRIPTION_ID = '".$_SESSION['prescriptions_id']."';";
		if (mysqli_query($conn, $sql2)) {
			$_SESSION['dispense-pat-id-num'] = "";
			$_SESSION['dispense-pat-name'] = "";
			$_SESSION['dispense-pat-surname'] = "";
			$_SESSION['dispense-pat-birth'] = "";
			$_SESSION['dispense-pat-gender'] = "";
			$_SESSION['dispense-doc-surname'] = "";
			$_SESSION['dispense-doc-name'] = "";
			$_SESSION['dispense-doc-contact-num'] = "";
			$_SESSION['dispense-doc-email'] = "";
			$_SESSION['dispense-doc-medical-practice'] = "";
			$_SESSION['dispense-prescription-id'] = "";
			$_SESSION['dispense-prescription-date'] = "";
			$_SESSION['dispense-prescription-disease'] = "";
			$_SESSION['dispense-prescription-medication'] = "";
			$_SESSION['dispense-prescription-dosage'] = "";
			$_SESSION['dispense-prescription-schedule'] = "";
			$_SESSION['dispense-prescription-act-ingredients'] = "";
			$_SESSION['dispense-prescription-quantity'] = "";
			$_SESSION['dispense-prescription-original-repeats'] = "";
			$_SESSION['dispense-prescription-current-repeats'] = "";
			$_SESSION['dispense-prescription-status'] = "";
			$_SESSION['dispense-prescription-instructions'] = "";
			$_SESSION['dispense-prescription-latest-date'] = "";
			
	  		echo("<script>alert('Dispense Prescription Successful')</script>");
	 		echo("<script>window.location = '../pharmacist-dispense-prescription.php?dispense-prescription=success';</script>");
	 		mysqli_close($conn);
			exit(); 
		} else {
	 		echo("<script>alert('Dispense Prescription Unsuccessful: Something went wrong, please try again.')</script>");
	 		echo("<script>window.location = '../pharmacist-dispense-prescription.php?dispense-prescription=error';</script>");
	 		mysqli_close($conn);
			exit(); 
		}
		
	} else {
 		echo("<script>alert('Dispense Prescription Unsuccessful: Something went wrong, please try again.')</script>");
 		echo("<script>window.location = '../pharmacist-dispense-prescription.php?dispense-prescription=error';</script>");
 		mysqli_close($conn);
		exit(); 
	}

} elseif (isset($_POST['btnReject'])) {
	if($_SESSION['dispense_pat_id_num'] == ""){
 		echo("<script>alert('Reject Prescription Unsuccessful: Patient personal details are empty.')</script>");
 		echo("<script>window.location = '../pharmacist-dispense-prescription.php?reject-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	if($_SESSION['dispense_prescription_id'] == ""){
 		echo("<script>alert('Reject Prescription Unsuccessful: Patient Prescription details are empty.')</script>");
 		echo("<script>window.location = '../pharmacist-dispense-prescription.php?reject-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	if($_SESSION['dispense_prescription_current_repeats'] <= 0){
 		echo("<script>alert('Reject Prescription Unsuccessful: There are no current repeats left.')</script>");
 		echo("<script>window.location = '../pharmacist-dispense-prescription.php?reject-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	if($_SESSION['dispense_prescription_status'] == 'Dispensed' || $_SESSION['dispense_prescription_status'] == 'Rejected'){
 		echo("<script>alert('Reject Prescription Unsuccessful: The prescription is already ".$_SESSION['dispense_prescription_status'].".')</script>");
 		echo("<script>window.location = '../pharmacist-dispense-prescription.php?reject-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	echo "
	<script>
		if (confirm('Reject Prescription Alert: Do you want to reject ".$_SESSION['dispense_prescription_medication']." prescription?')) {
			var reason;
			let dialog_box = prompt('Please provide a reason for rejecting the prescription:');
			if (dialog_box == null || dialog_box.trim() == '') {
				alert('Dispense Prescription Unsuccessful: Please provide a reason for rejecting the prescription.')
				window.location = '../pharmacist-dispense-prescription.php?reject-prescription=error'
			} else {
				window.location = 'data-reject-prescription.php?reject-reason=' + dialog_box;
			}
		} else {
			alert('Reject Prescription Unsuccessful: Press Ok, if you want to reject ".$_SESSION['dispense_prescription_medication']." prescription.')
			window.location = '../pharmacist-dispense-prescription.php?reject-prescription=error'
		}	
	</script>";
}else{
	session_unset();
	session_destroy();
	header("Location: ../index.php.php?load-prescription=error");
	mysqli_close($conn);
	exit(); 
}