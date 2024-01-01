<?php
session_start();

if (isset($_GET['allergy_checked']) && isset($_GET['med_interaction_checked']) && isset($_GET['med_contraindication_checked']) && !(isset($_POST['btnClear']))) {

	include_once 'data-connection.php';
	if($_GET['allergy_checked'] == 'no') {
	    $_SESSION['updates_prescription_id'] = mysqli_real_escape_string($conn, $_SESSION['update_prescription_id']);
	    $_SESSION['updates_ingredient_id'] = mysqli_real_escape_string($conn, $_SESSION['update-prescription-ingredient-id']);
	    $_SESSION['updates_disease'] = mysqli_real_escape_string($conn, $_POST['disease_name']);
	    $_SESSION['updates_disease_id'] = substr($_SESSION['updates_disease'], 0, 6);
	    $_SESSION['updates_medication'] = mysqli_real_escape_string($conn, $_POST['medication']);
	    $_SESSION['updates_med_id'] = substr($_SESSION['updates_medication'], 0, 7);
	    $_SESSION['updates_med_name'] = substr($_SESSION['updates_medication'], 10);
	    $_SESSION['updates_dosage_form'] = mysqli_real_escape_string($conn, $_POST['dosage_form']);
	    $_SESSION['updates_schedule'] = mysqli_real_escape_string($conn, $_POST['schedule']);
	    $_SESSION['updates_act_ingredients'] = mysqli_real_escape_string($conn, $_POST['act_ingredients']);
	    $_SESSION['updates_quantity'] = mysqli_real_escape_string($conn, $_POST['quantity']);
	    $_SESSION['updates_repeats'] = mysqli_real_escape_string($conn, $_POST['repeats']);
	    $_SESSION['updates_instructions'] = mysqli_real_escape_string($conn, $_POST['instructions']);
	    $_SESSION['updates_prescription_date'] = mysqli_real_escape_string($conn, $_POST['prescription_date']);
	    $_SESSION['updates_pat_id'] = mysqli_real_escape_string($conn, $_SESSION['update_prescription_id_num']);
		$_SESSION['updates_doc_id'] = mysqli_real_escape_string($conn, $_SESSION['doc_reg_num']); 
    }
   
    
	if($_SESSION['updates_pat_id'] == ""){
 		echo("<script>alert('Update Prescription Unsuccessful: Patient personal details are empty.')</script>");
 		echo("<script>window.location = '../doctor-update-prescriptions.php?load-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	if($_SESSION['update_prescription_status'] == "Dispensed"){
 		echo("<script>alert('Update Prescription Unsuccessful: The prescription status is dispensed.')</script>");
 		echo("<script>window.location = '../doctor-update-prescriptions.php?load-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}
    
	
	if($_GET['allergy_checked'] == 'no') {
		$sql1 = "SELECT * FROM MED_HISTORY WHERE PATIENT_ID ='".$_SESSION['updates_pat_id']."' AND NOT ALLERGY_ID ='NULL'";
		$result1 = mysqli_query($conn, $sql1);
		$resultCheck1 = mysqli_num_rows($result1);
		if($resultCheck1 > 0){
			$msg = "";
			while($row1 = mysqli_fetch_assoc($result1)){
                
				$sql2 = "SELECT * FROM ALLERGY WHERE ALLERGY_ID ='".$row1['ALLERGY_ID']."' AND MED_ID ='".$_SESSION['updates_med_id']."'";
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
					if (confirm('Medication Contra-indication: This patient have [".substr($msg, 0, -2)."] allergic reaction, ".$_SESSION['updates_med_name']." medication is not recommended for this patient. Do you want to ignore this alert?')) {
						var reason;
						let dialog_box = prompt('Please provide a reason for ignoring the alert:');
						if (dialog_box == null || dialog_box.trim() == '') {
							alert('Update Prescription Unsuccessful: Please provide a reason for ignoring the alert, Or select another medication that the patient is not allergic to.')
						  			window.location = '../doctor-update-prescriptions.php?update-prescription=error'
						} else {
							window.location = 'data-update-prescription-alert-message.php?alert-reason=' + dialog_box +'&test=1';
						}
					} else {
						alert('Update Prescription Unsuccessful: Please select another medication that the patient is not allergic to.')
						  		window.location = '../doctor-update-prescriptions.php?update-prescription=error'
					}	
				</script>";
				mysqli_close($conn);
				exit();
			}
		}
	}
	
	if($_GET['med_interaction_checked'] == 'no') {
		$sql1 = "SELECT * FROM MED_INTERACTION WHERE FIRST_MED ='".$_SESSION['updates_med_id']."'";
		$result1 = mysqli_query($conn, $sql1);
		$resultCheck1 = mysqli_num_rows($result1);
		if($resultCheck1 > 0){
			$msg = "";
			while($row1 = mysqli_fetch_assoc($result1)){

				$sql2 = "SELECT * FROM PRESCRIPTION WHERE PATIENT_ID ='".$_SESSION['updates_pat_id']."' AND NOT CURRENT_REPEATS = '0'";
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
					if (confirm('Medication Interaction: This patient is using [".substr($msg, 0, -2)."] which can cause a medication interaction when used with ".$_SESSION['updates_med_name'].". Do you want to ignore this alert?')) {
						var reason;
						let dialog_box = prompt('Please provide a reason for ignoring the alert:');
						if (dialog_box == null || dialog_box.trim() == '') {
							alert('Update Prescription Unsuccessful: Please provide a reason for ignoring the alert, Or select another medication that does not have a medication interaction.')
						  			window.location = '../doctor-update-prescriptions.php?update-prescription=error'
						} else {
							window.location = 'data-update-prescription-alert-message.php?alert-reason=' + dialog_box +'&test=2';
						}
					} else {
						alert('Update Prescription Unsuccessful: Please select another medication that does not have a medication interaction.')
						  		window.location = '../doctor-update-prescriptions.php?update-prescription=error'
					}	
				</script>";
				mysqli_close($conn);
				exit();
			}
		}
	}
	
	if($_GET['med_contraindication_checked'] == 'no') {
		$sql1 = "SELECT * FROM CONTRA_INDICATION WHERE MED_ID ='".$_SESSION['updates_med_id']."'";
		$result1 = mysqli_query($conn, $sql1);
		$resultCheck1 = mysqli_num_rows($result1);
		if($resultCheck1 > 0){
			$msg = "";
			while($row1 = mysqli_fetch_assoc($result1)){
				$sql2 = "SELECT * FROM MED_HISTORY WHERE PATIENT_ID = '".$_SESSION['updates_pat_id']."' AND DISEASE_ID = '".$row1['DISEASE_ID']."'";
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
					if (confirm('Medication Contra-indication: This patient is have [".substr($msg, 0, -2)."] disease, ".$_SESSION['updates_med_name']." medication is not recommended for this patient. Do you want to ignore this alert?')) {
						var reason;
						let dialog_box = prompt('Please provide a reason for ignoring the alert:');
						if (dialog_box == null || dialog_box.trim() == '') {
							alert('Update Prescription Unsuccessful: Please provide a reason for ignoring the alert, Or select another medication that does not have a medication contra-indication.')
						  			window.location = '../doctor-update-prescriptions.php?update-prescription=error'
						} else {
							window.location = 'data-update-prescription-alert-message.php?alert-reason=' + dialog_box +'&test=3';
						}
					} else {
						alert('Update Prescription Unsuccessful: Please select another medication that does not have a medication contra-indication.')
						  		window.location = '../doctor-update-prescriptions.php?update-prescription=error'
					}	
				</script>";
				mysqli_close($conn);
				exit();
			}
		}
	}

	$sql1 = "UPDATE PRESCRIPTION SET
	DISEASE_ID = '".$_SESSION['updates_disease_id']."',
	MED_ID = '".$_SESSION['updates_med_id']."',
	DOSAGE_FORM = '".$_SESSION['updates_dosage_form']."',
	SCHEDULE = '".$_SESSION['updates_schedule']."',
	INGREDIENT_ID = '".$_SESSION['updates_ingredient_id']."',
	QUANTITY = '".$_SESSION['updates_quantity']."',
	ORIGINAL_REPEATS = '".$_SESSION['updates_repeats']."',
	CURRENT_REPEATS = '".$_SESSION['updates_repeats']."',
	STATUS = 'Prescribed',
	INSTRUCTIONS = '".$_SESSION['updates_instructions']."',
	PRESCRIPTION_DATE = '".$_SESSION['updates_prescription_date']."',
	DOCTOR_ID = '".$_SESSION['updates_doc_id']."',
	PATIENT_ID = '".$_SESSION['updates_pat_id']."'
	WHERE PRESCRIPTION_ID = '".$_SESSION['updates_prescription_id']."';";
	 
	if (mysqli_query($conn, $sql1)) {
		
		$sql2 = "UPDATE ACTIVE_INGREDIENT SET
		NAME = '".$_SESSION['updates_act_ingredients']."',
		MED_ID = '".$_SESSION['updates_med_id']."',
		PRESCRIPTION_ID = '".$_SESSION['updates_prescription_id']."'
		WHERE INGREDIENT_ID = '".$_SESSION['updates_ingredient_id']."';";

		if (mysqli_query($conn, $sql2)) {
			$_SESSION['update-prescription-name'] = "";
			$_SESSION['update-prescription-surname'] = "";
			$_SESSION['update-prescription-id-num'] = "";
			$_SESSION['update-prescription-gender'] = "";
			$_SESSION['update-prescription-birth'] = "";
			$_SESSION['update-prescription-id'] = "";
			$_SESSION['update-prescription-disease'] = "";
			$_SESSION['update-prescription-medication'] = "";
			$_SESSION['update-prescription-dosage'] = "";
			$_SESSION['update-prescription-schedule'] = "";
			$_SESSION['update-prescription-act-ingredients'] = "";
			$_SESSION['update-prescription-quantity'] = "";
			$_SESSION['update-prescription-repeats'] = "";
			$_SESSION['update-prescription-status'] = "";
			$_SESSION['update-prescription-instructions'] = "";
			$_SESSION['update-prescription-date'] = "";
			
	  		echo("<script>alert('Update Prescription Successful')</script>");
	 		echo("<script>window.location = '../doctor-update-prescriptions.php?update-prescription=success';</script>");
	 		mysqli_close($conn);
			exit(); 
		} else {
	 		echo("<script>alert('Upadate Prescription Unsuccessful: Something went wrong, please try again.')</script>");
	 		echo("<script>window.location = '../doctor-update-prescriptions.php?update-prescription=error';</script>");
	 		mysqli_close($conn);
			exit(); 
		}
		
	} else {
 		echo("<script>alert('Upadate Prescription Unsuccessful: Something went wrong, please try again.')</script>");
 		echo("<script>window.location = '../doctor-update-prescriptions.php?update-prescription=error';</script>");
 		mysqli_close($conn);
		exit(); 
	}

} elseif (isset($_POST['btnClear'])) {
	$_SESSION['update-prescription-name'] = "";
	$_SESSION['update-prescription-surname'] = "";
	$_SESSION['update-prescription-id-num'] = "";
	$_SESSION['update-prescription-gender'] = "";
	$_SESSION['update-prescription-birth'] = "";
	$_SESSION['update-prescription-id'] = "";
	$_SESSION['update-prescription-disease'] = "";
	$_SESSION['update-prescription-medication'] = "";
	$_SESSION['update-prescription-dosage'] = "";
	$_SESSION['update-prescription-schedule'] = "";
	$_SESSION['update-prescription-act-ingredients'] = "";
	$_SESSION['update-prescription-quantity'] = "";
	$_SESSION['update-prescription-repeats'] = "";
	$_SESSION['update-prescription-status'] = "";
	$_SESSION['update-prescription-instructions'] = "";
	$_SESSION['update-prescription-date'] = "";
	echo("<script>window.location = '../doctor-update-prescriptions.php?clear-update-prescriptions=success';</script>");
}else{
	session_unset();
	session_destroy();
	header("Location: ../index.php.php?load-prescription=error");
	mysqli_close($conn);
	exit(); 
}