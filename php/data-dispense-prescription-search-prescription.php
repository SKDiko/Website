<?php
session_start();
if (isset($_POST['btnSearch'])) {
	include 'data-connection.php'; 
	$prescription_name = mysqli_real_escape_string($conn, $_POST['prescription_id']);
	$prescription_id = substr(mysqli_real_escape_string($conn, $_POST['prescription_id']), 0, 10);
	$sql = "SELECT * FROM PRESCRIPTION WHERE PRESCRIPTION_ID ='$prescription_id'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	
	if($resultCheck < 1){
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

		echo("<script>alert('Search Unsuccessful: Prescription ".$prescription_name." not found, Please try again.')</script>");
		echo("<script>window.location = '../pharmacist-dispense-prescription.php?prescription-search=error';</script>");
 		mysqli_close($conn);
		exit();
	}else{
		if($row = mysqli_fetch_assoc($result)){
			$sql2 = "SELECT * FROM DOCTOR WHERE REGISTRATION_NUM = '".$row['DOCTOR_ID']."'";
			$result2 = mysqli_query($conn, $sql2);
			$resultCheck2 = mysqli_num_rows($result2);
			if($resultCheck2 > 0){
				if ($row2 = mysqli_fetch_assoc($result2)) {
					$_SESSION['dispense-doc-surname'] = $row2['SURNAME'];
					$_SESSION['dispense-doc-name'] = $row2['NAME'];
					$_SESSION['dispense-doc-contact-num'] = $row2['CONTACT_NUMBER'];
					$_SESSION['dispense-doc-email'] = $row2['EMAIL'];
				}	
			}

			$sql7 = "SELECT * FROM MEDICAL_PRACTICE WHERE PRACTICE_NUM = '".$row2['PRACTICE_NUM']."'";
			$result7 = mysqli_query($conn, $sql7);
			$resultCheck7 = mysqli_num_rows($result7);
			if($resultCheck7 > 0){
				if ($row7 = mysqli_fetch_assoc($result7)) {
					$_SESSION['dispense-doc-medical-practice'] = $row7['NAME'];
				}	
			}

			$_SESSION['dispense-prescription-id'] = $row['PRESCRIPTION_ID'];
			$_SESSION['dispense-prescription-date'] = $row['PRESCRIPTION_DATE'];

			$sql3 = "SELECT * FROM DISEASE WHERE DISEASE_ID = '".$row['DISEASE_ID']."'";
			$result3 = mysqli_query($conn, $sql3);
			$resultCheck3 = mysqli_num_rows($result3);
			if($resultCheck3 > 0){
				if ($row3 = mysqli_fetch_assoc($result3)) {
					$_SESSION['dispense-prescription-disease'] = $row3['NAME'];
				}	
			}

			$sql4 = "SELECT * FROM MEDICATION WHERE MED_ID = '".$row['MED_ID']."'";
			$result4 = mysqli_query($conn, $sql4);
			$resultCheck4 = mysqli_num_rows($result4);
			if($resultCheck4 > 0){
				if ($row4 = mysqli_fetch_assoc($result4)) {
					$_SESSION['dispense-prescription-medication'] = $row4['NAME'];
				}	
			}

			$_SESSION['dispense-prescription-dosage'] = $row['DOSAGE_FORM'];
			$_SESSION['dispense-prescription-schedule'] = $row['SCHEDULE'];

			$sql5 = "SELECT * FROM ACTIVE_INGREDIENT WHERE PRESCRIPTION_ID = '".$row['PRESCRIPTION_ID']."' AND INGREDIENT_ID = '".$row['INGREDIENT_ID']."'";
			$result5 = mysqli_query($conn, $sql5);
			$resultCheck5 = mysqli_num_rows($result5);
			if($resultCheck5 > 0){
				if ($row5 = mysqli_fetch_assoc($result5)) {
					$_SESSION['dispense-prescription-act-ingredients'] = $row5['NAME'];
				}	
			}

			$_SESSION['dispense-prescription-quantity'] = $row['QUANTITY'];
			$_SESSION['dispense-prescription-original-repeats'] = $row['ORIGINAL_REPEATS'];
			$_SESSION['dispense-prescription-current-repeats'] = $row['CURRENT_REPEATS'];
			$_SESSION['dispense-prescription-status'] = $row['STATUS'];
			$_SESSION['dispense-prescription-instructions'] = $row['INSTRUCTIONS'];
			
			header("Location: ../pharmacist-dispense-prescription.php?prescription-search=success");
			mysqli_close($conn);
			exit();
		}
	}
}else{
	header("Location: ../index.php?patient-search=error");
	session_unset();
	session_destroy();
	mysqli_close($conn);
	exit();
}