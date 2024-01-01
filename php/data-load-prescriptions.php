<?php
session_start();

if (isset($_GET['allergy_checked']) && isset($_GET['med_interaction_checked']) && isset($_GET['med_contraindication_checked']) && !(isset($_POST['btnClear']))) {

	include_once 'data-connection.php';
	if($_GET['allergy_checked'] == 'no') {
	    $_SESSION['load_prescription_id'] = substr(md5(uniqid('', true)), 0, 10);
	    $_SESSION['load_ingredient_id'] = substr(md5(uniqid('', true)), 0, 10);
	    $_SESSION['load_disease'] = mysqli_real_escape_string($conn, $_POST['disease_name']);
	    $_SESSION['load_disease_id'] = substr($_SESSION['load_disease'], 0, 6);
	    $_SESSION['load_medication'] = mysqli_real_escape_string($conn, $_POST['medication']);
	    $_SESSION['load_med_id'] = substr($_SESSION['load_medication'], 0, 7);
	    $_SESSION['load_med_name'] = substr($_SESSION['load_medication'], 10);
	    $_SESSION['load_dosage_form'] = mysqli_real_escape_string($conn, $_POST['dosage_form']);
	    $_SESSION['load_schedule'] = mysqli_real_escape_string($conn, $_POST['schedule']);
	    $_SESSION['load_act_ingredients'] = mysqli_real_escape_string($conn, $_POST['act_ingredients']);
	    $_SESSION['load_quantity'] = mysqli_real_escape_string($conn, $_POST['quantity']);
	    $_SESSION['load_repeats'] = mysqli_real_escape_string($conn, $_POST['repeats']);
	    $_SESSION['load_instructions'] = mysqli_real_escape_string($conn, $_POST['instructions']);
	    $_SESSION['load_prescription_date'] = mysqli_real_escape_string($conn, $_POST['prescription_date']);
	    $_SESSION['load_pat_id'] = mysqli_real_escape_string($conn, $_SESSION['load_prescription_id_num']);
		$_SESSION['load_doc_id'] = mysqli_real_escape_string($conn, $_SESSION['doc_reg_num']); 
    }
    
	if($_SESSION['load_pat_id'] == ""){
 		echo("<script>alert('Load Prescription Unsuccessful: Patient personal details are empty.')</script>");
 		echo("<script>window.location = '../doctor-load-prescriptions.php?load-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}
    
    $sql = "SELECT * FROM PRESCRIPTION WHERE PRESCRIPTION_ID ='".$_SESSION['load_prescription_id']."'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		echo("<script>alert('Load Prescription Unsuccessful: Something went wrong, please try again.')</script>");
 		echo("<script>window.location = '../doctor-load-prescriptions.php?load-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	$sql = "SELECT * FROM ACTIVE_INGREDIENT WHERE INGREDIENT_ID ='".$_SESSION['load_ingredient_id']."'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		echo("<script>alert('Load Prescription Unsuccessful: Something went wrong, please try again.')</script>");
 		echo("<script>window.location = '../doctor-load-prescriptions.php?load-prescription=error';</script>");
 		mysqli_close($conn);
		exit();
	}

	if($_GET['allergy_checked'] == 'no') {
		$sql1 = "SELECT * FROM MED_HISTORY WHERE PATIENT_ID ='".$_SESSION['load_pat_id']."' AND NOT ALLERGY_ID ='NULL'";
		$result1 = mysqli_query($conn, $sql1);
		$resultCheck1 = mysqli_num_rows($result1);
		if($resultCheck1 > 0){
			$msg = "";
			while($row1 = mysqli_fetch_assoc($result1)){
                
				$sql2 = "SELECT * FROM ALLERGY WHERE ALLERGY_ID ='".$row1['ALLERGY_ID']."' AND MED_ID ='".$_SESSION['load_med_id']."'";
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
					if (confirm('Medication Contra-indication: This patient have [".substr($msg, 0, -2)."] allergic reaction, ".$_SESSION['load_med_name']." medication is not recommended for this patient. Do you want to ignore this alert?')) {
						var reason;
						let dialog_box = prompt('Please provide a reason for ignoring the alert:');
						if (dialog_box == null || dialog_box.trim() == '') {
							alert('Load Prescription Unsuccessful: Please provide a reason for ignoring the alert, Or select another medication that the patient is not allergic to.')
						  			window.location = '../doctor-load-prescriptions.php?load-prescription=error'
						} else {
							window.location = 'data-alert-message.php?alert-reason=' + dialog_box +'&test=1';
						}
					} else {
						alert('Load Prescription Unsuccessful: Please select another medication that the patient is not allergic to.')
						  		window.location = '../doctor-load-prescriptions.php?load-prescription=error'
					}	
				</script>";
				mysqli_close($conn);
				exit();
			}
		}
	}


	if($_GET['med_interaction_checked'] == 'no') {
		$sql1 = "SELECT * FROM MED_INTERACTION WHERE FIRST_MED ='".$_SESSION['load_med_id']."'";
		$result1 = mysqli_query($conn, $sql1);
		$resultCheck1 = mysqli_num_rows($result1);
		if($resultCheck1 > 0){
			$msg = "";
			while($row1 = mysqli_fetch_assoc($result1)){

				$sql2 = "SELECT * FROM PRESCRIPTION WHERE PATIENT_ID ='".$_SESSION['load_pat_id']."' AND NOT CURRENT_REPEATS = '0'";
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
					if (confirm('Medication Interaction: This patient is using [".substr($msg, 0, -2)."] which can cause a medication interaction when used with ".$_SESSION['load_med_name'].". Do you want to ignore this alert?')) {
						var reason;
						let dialog_box = prompt('Please provide a reason for ignoring the alert:');
						if (dialog_box == null || dialog_box.trim() == '') {
							alert('Load Prescription Unsuccessful: Please provide a reason for ignoring the alert, Or select another medication that does not have a medication interaction.')
						  			window.location = '../doctor-load-prescriptions.php?load-prescription=error'
						} else {
							window.location = 'data-alert-message.php?alert-reason=' + dialog_box +'&test=2';
						}
					} else {
						alert('Load Prescription Unsuccessful: Please select another medication that does not have a medication interaction.')
						  		window.location = '../doctor-load-prescriptions.php?load-prescription=error'
					}	
				</script>";
				mysqli_close($conn);
				exit();
			}
		}
	}

	if($_GET['med_contraindication_checked'] == 'no') {
		$sql1 = "SELECT * FROM CONTRA_INDICATION WHERE MED_ID ='".$_SESSION['load_med_id']."'";
		$result1 = mysqli_query($conn, $sql1);
		$resultCheck1 = mysqli_num_rows($result1);
		if($resultCheck1 > 0){
			$msg = "";
			while($row1 = mysqli_fetch_assoc($result1)){
				$sql2 = "SELECT * FROM MED_HISTORY WHERE PATIENT_ID = '".$_SESSION['load_pat_id']."' AND DISEASE_ID = '".$row1['DISEASE_ID']."'";
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
					if (confirm('Medication Contra-indication: This patient is have [".substr($msg, 0, -2)."] disease, ".$_SESSION['load_med_name']." medication is not recommended for this patient. Do you want to ignore this alert?')) {
						var reason;
						let dialog_box = prompt('Please provide a reason for ignoring the alert:');
						if (dialog_box == null || dialog_box.trim() == '') {
							alert('Load Prescription Unsuccessful: Please provide a reason for ignoring the alert, Or select another medication that does not have a medication contra-indication.')
						  			window.location = '../doctor-load-prescriptions.php?load-prescription=error'
						} else {
							window.location = 'data-alert-message.php?alert-reason=' + dialog_box +'&test=3';
						}
					} else {
						alert('Load Prescription Unsuccessful: Please select another medication that does not have a medication contra-indication.')
						  		window.location = '../doctor-load-prescriptions.php?load-prescription=error'
					}	
				</script>";
				mysqli_close($conn);
				exit();
			}
		}
	}
   
	$sql1 = "INSERT INTO PRESCRIPTION (PRESCRIPTION_ID, DISEASE_ID, MED_ID, DOSAGE_FORM, SCHEDULE, INGREDIENT_ID, QUANTITY, ORIGINAL_REPEATS, CURRENT_REPEATS, STATUS, INSTRUCTIONS, PRESCRIPTION_DATE, DOCTOR_ID, PATIENT_ID)
	VALUES (
	 '".$_SESSION['load_prescription_id']."',
	 '".$_SESSION['load_disease_id']."',
	 '".$_SESSION['load_med_id']."',
	 '".$_SESSION['load_dosage_form']."',
	 '".$_SESSION['load_schedule']."',
	 '".$_SESSION['load_ingredient_id']."',
	 '".$_SESSION['load_quantity']."',
	 '".$_SESSION['load_repeats']."',
	 '".$_SESSION['load_repeats']."',
	 'Prescribed',
	 '".$_SESSION['load_instructions']."',
	 '".$_SESSION['load_prescription_date']."',
	 '".$_SESSION['load_doc_id']."',
	 '".$_SESSION['load_pat_id']."'
	);";
	if (mysqli_query($conn, $sql1)) {
		
		$sql2 = "INSERT INTO ACTIVE_INGREDIENT (INGREDIENT_ID, NAME, MED_ID, PRESCRIPTION_ID)
		VALUES (
			'".$_SESSION['load_ingredient_id']."',
			'".$_SESSION['load_act_ingredients']."',
			'".$_SESSION['load_med_id']."',
			'".$_SESSION['load_prescription_id']."'
		);";
		if (mysqli_query($conn, $sql2)) {
			$_SESSION['load-prescription-id-num'] = "";
			$_SESSION['load-prescription-name'] = "";
			$_SESSION['load-prescription-surname'] = "";
			$_SESSION['load-prescription-birth'] = "";
			$_SESSION['load-prescription-gender'] = "";
			
	  		echo("<script>alert('Load Prescription Successful')</script>");
	 		echo("<script>window.location = '../doctor-load-prescriptions.php?load-prescription=success';</script>");
	 		mysqli_close($conn);
			exit(); 
		} else {
	 		echo("<script>alert('Load Prescription Unsuccessful: Something went wrong, please try again.')</script>");
	 		echo("<script>window.location = '../doctor-load-prescriptions.php?load-prescription=error';</script>");
	 		mysqli_close($conn);
			exit(); 
		}
		
	} else {
 		echo("<script>alert('Load Prescription Unsuccessful: Something went wrong, please try again.')</script>");
 		echo("<script>window.location = '../doctor-load-prescriptions.php?load-prescription=error';</script>");
 		mysqli_close($conn);
		exit(); 
	}

} elseif (isset($_POST['btnClear'])) {
	$_SESSION['load-prescription-id-num'] = "";
	$_SESSION['load-prescription-name'] = "";
	$_SESSION['load-prescription-surname'] = "";
	$_SESSION['load-prescription-birth'] = "";
	$_SESSION['load-prescription-gender'] = "";
	echo("<script>window.location = '../doctor-load-prescriptions.php?clear-load-prescriptions=success';</script>");
}else{
	session_unset();
	session_destroy();
	header("Location: ../index.php?load-prescription=error");
	mysqli_close($conn);
	exit(); 
}