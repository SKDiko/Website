<?php
session_start();

if (isset($_GET['allergy_checked']) && isset($_GET['med_interaction_checked']) && isset($_GET['med_contraindication_checked']) && isset($_GET['dispense_days_checked']) && !(isset($_POST['btnReject'])) && !(isset($_POST['btnbtnView']))) {

	include_once 'data-connection.php';

	if($_GET['allergy_checked'] == 'no') {
		$_SESSION['dispense_id'] = substr(md5(uniqid('', true)), 0, 10);
		$_SESSION['dispense_date'] = mysqli_real_escape_string($conn, $_POST['dispense_date']);
		$_SESSION['prescriptions_id'] = mysqli_real_escape_string($conn, $_GET['prescription_id']);
		$_SESSION['dispense_pharm_reg_num'] = mysqli_real_escape_string($conn, $_SESSION['pharm_reg_num']);
		$_SESSION['dispense_pharmacy_id'] = mysqli_real_escape_string($conn, $_SESSION['pharm_pharmacy_id']);
		$_SESSION['dispense_patient_id_num'] = mysqli_real_escape_string($conn, $_SESSION['view_prescriptions_pat_id_num']);
		$_SESSION['dispense_current_repeats'] = mysqli_real_escape_string($conn, ($_GET['repeats'] - 1));
		$_SESSION['dispense_prescription_latest_date'] = $_GET['dispense-latest-date'];
		$_SESSION['dispense_repeats'] = $_GET['repeats'];
		$_SESSION['dispense_status'] = $_GET['status'];
		$_SESSION['dispense_med_name'] = $_GET['med_name'];
		$_SESSION['dispense_med_id'] = $_GET['med_id'];
		$_SESSION['dispensing_date'] = date('Y-m-d', strtotime($_SESSION['dispense_prescription_latest_date']. ' + 20 days'));
	}

	if($_SESSION['dispense_repeats'] <= 0){
 		echo("<script>alert('Dispense Prescription Unsuccessful: There are no repeats left for ".$_SESSION['dispense_med_name'].".')</script>");
 		echo("<script>window.location = '../pharmacist-view-prescriptions.php?dispense-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	if($_SESSION['dispense_status'] == 'Rejected'){
 		echo("<script>alert('Dispense Prescription Unsuccessful: The prescription for ".$_SESSION['dispense_med_name']." have been rejected.')</script>");
 		echo("<script>window.location = '../pharmacist-view-prescriptions.php?dispense-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}
    
    $sql = "SELECT * FROM DISPENSE_PRESCRIPTION WHERE DISPENSE_ID ='".$_SESSION['dispense_id']."'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		echo("<script>alert('Dispense Prescription Unsuccessful: Something went wrong, please try again.')</script>");
 		echo("<script>window.location = '../pharmacist-view-prescriptions.php?dispense-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}
    
	if($_GET['allergy_checked'] == 'no') {
		$sql1 = "SELECT * FROM MED_HISTORY WHERE PATIENT_ID ='".$_SESSION['dispense_patient_id_num']."' AND NOT ALLERGY_ID ='NULL'";
		$result1 = mysqli_query($conn, $sql1);
		$resultCheck1 = mysqli_num_rows($result1);
		if($resultCheck1 > 0){
			$msg = "";
			while($row1 = mysqli_fetch_assoc($result1)){

				$sql2 = "SELECT * FROM ALLERGY WHERE ALLERGY_ID ='".$row1['ALLERGY_ID']."' AND MED_ID ='".$_SESSION['dispense_med_id']."'";
				$result2 = mysqli_query($conn, $sql2);
				$resultCheck2 = mysqli_num_rows($result2);
				if($resultCheck2 > 0){
					if($row2 = mysqli_fetch_assoc($result2)){
						$msg .= $row2['NAME'].", ";
					}
				}
			}
			if ($msg != ""){
				echo "
				<script>
					if (confirm('Medication Allergic Reaction: This patient have [".substr($msg, 0, -2)."] allergic reaction, ".$_SESSION['dispense_med_name']." medication is not recommended for this patient. Do you want to ignore this alert?')) {
						var reason;
						let dialog_box = prompt('Please provide a reason for ignoring the alert:');
						if (dialog_box == null || dialog_box.trim() == '') {
							alert('Dispense Prescription Unsuccessful: Please provide a reason for ignoring the alert, Or select another medication that the patient is not allergic to.')
						  			window.location = '../pharmacist-view-prescriptions.php?dispense-prescription=error'
						} else {
							window.location = 'data-dispense-alert-message.php?alert-reason=' + dialog_box +'&test=1';
						}
					} else {
						alert('Dispense Prescription Unsuccessful: Please select another medication that the patient is not allergic to.')
						  		window.location = '../pharmacist-view-prescriptions.php?dispense-prescription=error'
					}	
				</script>";
				mysqli_close($conn);
				exit();
			}
		}
	}
    
    if($_GET['med_interaction_checked'] == 'no') {
		$sql1 = "SELECT * FROM MED_INTERACTION WHERE FIRST_MED ='".$_SESSION['dispense_med_id']."'";
		$result1 = mysqli_query($conn, $sql1);
		$resultCheck1 = mysqli_num_rows($result1);
		if($resultCheck1 > 0){
			$msg = "";
			while($row1 = mysqli_fetch_assoc($result1)){

				$sql2 = "SELECT * FROM PRESCRIPTION WHERE PATIENT_ID ='".$_SESSION['dispense_patient_id_num']."' AND NOT CURRENT_REPEATS = '0' AND NOT STATUS ='Unconfirmed'";
				$result2 = mysqli_query($conn, $sql2);
				$resultCheck2 = mysqli_num_rows($result2);
				if($resultCheck2 > 0){
					while($row2 = mysqli_fetch_assoc($result2)){

						if($row1['SECOND_MED'] == $row2['MED_ID']){
							
							$sql3 = "SELECT * FROM MEDICATION WHERE MED_ID ='".$row1['SECOND_MED']."'";
							$result3 = mysqli_query($conn, $sql3);
							$resultCheck3 = mysqli_num_rows($result3);
							if($resultCheck3 > 0){
								if($row3 = mysqli_fetch_assoc($result3)){
									$msg .= $row3['NAME'].", ";
								}
							}

						}
					}
				}
			}
			if ($msg != ""){
				echo "
				<script>
					if (confirm('Medication Interaction: This patient is using [".substr($msg, 0, -2)."] which can cause a medication interaction when used with ".$_SESSION['dispense_med_name'].". Do you want to ignore this alert?')) {
						var reason;
						let dialog_box = prompt('Please provide a reason for ignoring the alert:');
						if (dialog_box == null || dialog_box.trim() == '') {
							alert('Dispense Prescription Unsuccessful: Please provide a reason for ignoring the alert, Or select another medication that does not have a medication interaction.')
						  			window.location = '../pharmacist-view-prescriptions.php?dispense-prescription=error'
						} else {
							window.location = 'data-dispense-alert-message.php?alert-reason=' + dialog_box +'&test=2';
						}
					} else {
						alert('Dispense Prescription Unsuccessful: Please select another medication that does not have a medication interaction.')
						  		window.location = '../pharmacist-view-prescriptions.php?dispense-prescription=error'
					}	
				</script>";
				mysqli_close($conn);
				exit();
			}
		}
	}

	if($_GET['med_contraindication_checked'] == 'no') {
		$sql1 = "SELECT * FROM CONTRA_INDICATION WHERE MED_ID ='".$_SESSION['dispense_med_id']."'";
		$result1 = mysqli_query($conn, $sql1);
		$resultCheck1 = mysqli_num_rows($result1);
		if($resultCheck1 > 0){
			$msg = "";
			while($row1 = mysqli_fetch_assoc($result1)){
				$sql2 = "SELECT * FROM MED_HISTORY WHERE PATIENT_ID = '".$_SESSION['dispense_patient_id_num']."' AND DISEASE_ID = '".$row1['DISEASE_ID']."'";
				$result2 = mysqli_query($conn, $sql2);
				$resultCheck2 = mysqli_num_rows($result2);
				if($resultCheck2 > 0){
					while($row2 = mysqli_fetch_assoc($result2)){
						if($row1['DISEASE_ID'] == $row2['DISEASE_ID']){
							
							$sql3 = "SELECT * FROM DISEASE WHERE DISEASE_ID ='".$row1['DISEASE_ID']."'";
							$result3 = mysqli_query($conn, $sql3);
							$resultCheck3 = mysqli_num_rows($result3);
							if($resultCheck3 > 0){
								if($row3 = mysqli_fetch_assoc($result3)){
									$msg .= $row3['NAME'].", ";
								}
							}
						}
					}
				}
			}
			if ($msg != ""){
				echo "
				<script>
					if (confirm('Medication Contra-indication: This patient is have [".substr($msg, 0, -2)."] disease, ".$_SESSION['dispense_med_name']." medication is not recommended for this patient. Do you want to ignore this alert?')) {
						var reason;
						let dialog_box = prompt('Please provide a reason for ignoring the alert:');
						if (dialog_box == null || dialog_box.trim() == '') {
							alert('Dispense Prescription Unsuccessful: Please provide a reason for ignoring the alert, Or select another medication that does not have a medication contra-indication.')
						  			window.location = '../pharmacist-view-prescriptions.php?dispense-prescription=error'
						} else {
							window.location = 'data-dispense-alert-message.php?alert-reason=' + dialog_box +'&test=3';
						}
					} else {
						alert('Dispense Prescription Unsuccessful: Please select another medication that does not have a medication contra-indication.')
						  		window.location = '../pharmacist-view-prescriptions.php?dispense-prescription=error'
					}	
				</script>";
				mysqli_close($conn);
				exit();
			}
		}
	}

	if($_GET['dispense_days_checked'] == 'no' && $_SESSION['dispense_prescription_latest_date'] != "None") {

		if($_SESSION['dispense_date'] <= $_SESSION['dispense_prescription_latest_date']){
	 		echo("<script>alert('Dispense Prescription Unsuccessful: Current Dispense Date: ".$_SESSION['dispense_date']." have to be greater than Last Dispense Date: ".$_SESSION['dispense_prescription_latest_date'].".')</script>");
	 		echo("<script>window.location = '../pharmacist-view-prescriptions.php?dispense-prescription=error';</script>");
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
						  	window.location = '../pharmacist-view-prescriptions.php?dispense-prescription=error'
					} else {
						window.location = 'data-dispense-alert-message.php?alert-reason=' + dialog_box +'&test=4';
					}
				} else {
				   alert('Dispense Prescription Unsuccessful: The prescription must be dispensed again on the ".$_SESSION['dispensing_date'].".')
					window.location = '../pharmacist-view-prescriptions.php?dispense-prescription=error'
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
			
	  		echo("<script>alert('Dispense Prescription Successful')</script>");
	 		echo("<script>window.location = '../pharmacist-view-prescriptions.php?dispense-prescription=success';</script>");
	 		mysqli_close($conn);
			exit(); 
		} else {
	 		echo("<script>alert('Dispense Prescription Unsuccessful: Something went wrong, please try again.')</script>");
	 		echo("<script>window.location = '../pharmacist-view-prescriptions.php?dispense-prescription=error';</script>");
	 		mysqli_close($conn);
			exit(); 
		}
		
	} else {
 		echo("<script>alert('Dispense Prescription Unsuccessful: Something went wrong, please try again.')</script>");
 		echo("<script>window.location = '../pharmacist-view-prescriptions.php?dispense-prescription=error';</script>");
 		mysqli_close($conn);
		exit(); 
	}

} elseif (isset($_POST['btnView'])) {
	if($_GET['status'] != 'Dispensed'){
 		echo("<script>alert('View Prescription Unsuccessful: The prescription ".$_GET['med_name'].", have not yet been dispensed.')</script>");
 		echo("<script>window.location = '../pharmacist-view-prescriptions.php?view-prescription=error';</script>");
		exit();
	} else {
		echo("<script>window.location = '../pharmacist-view-dispensed-prescription.php?pre_id=".$_GET['prescription_id']."&med_name=".$_GET['med_name']."';</script>");
	}
	
} elseif (isset($_POST['btnReject'])) {

	if($_GET['repeats'] <= 0){
 		echo("<script>alert('Reject Prescription Unsuccessful: There are no repeats left for ".$_GET['med_name'].".')</script>");
 		echo("<script>window.location = '../pharmacist-view-prescriptions.php?reject-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	if($_GET['status'] == 'Dispensed' || $_GET['status'] == 'Rejected'){
 		echo("<script>alert('Reject Prescription Unsuccessful: The prescription ".$_GET['med_name']." is already ".$_GET['status'].".')</script>");
 		echo("<script>window.location = '../pharmacist-view-prescriptions.php?reject-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}
    
	echo "
	<script>
		if (confirm('Reject Prescription Alert: Do you want to reject ".$_GET['med_name']." prescription?')) {
			var reason;
			let dialog_box = prompt('Please provide a reason for rejecting the prescription:');
			if (dialog_box == null || dialog_box.trim() == '') {
				alert('Dispense Prescription Unsuccessful: Please provide a reason for rejecting the prescription.')
				window.location = '../pharmacist-view-prescriptions.php?reject-prescription=error'
			} else {
				window.location = 'data-pharmacist-reject-prescription.php?reject-reason=' + dialog_box + '&prescription_id='+'".$_GET['prescription_id']."' + '&doc_id='+'".$_GET['doc_id']."' + '&med_name='+'".$_GET['med_name']."';
			}
		} else {
			alert('Reject Prescription Unsuccessful: Press Ok, if you want to reject ".$_GET['med_name']." prescription.')
			window.location = '../pharmacist-view-prescriptions.php?reject-prescription=error'
		}	
	</script>";
	
}else{
	session_unset();
	session_destroy();
	header("Location: ../index.php?load-prescription=error");
	mysqli_close($conn);
	exit(); 
}