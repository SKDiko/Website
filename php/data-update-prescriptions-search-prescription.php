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

		echo("<script>alert('Search Unsuccessful: Prescription ".$prescription_name." not found, Please try again.')</script>");
		echo("<script>window.location = '../doctor-update-prescriptions.php?prescription-search=error';</script>");
 		mysqli_close($conn);
		exit();
	}else{
		if($row = mysqli_fetch_assoc($result)){
			$sql2 = "SELECT * FROM PATIENT WHERE ID_NUMBER = '".$row['PATIENT_ID']."'";
			$result2 = mysqli_query($conn, $sql2);
			$resultCheck2 = mysqli_num_rows($result2);
			if($resultCheck2 > 0){
				if ($row2 = mysqli_fetch_assoc($result2)) {
					$_SESSION['update-prescription-surname'] = $row2['SURNAME'];
					$_SESSION['update-prescription-name'] = $row2['NAME'];
					$_SESSION['update-prescription-birth'] = $row2['DATE_OF_BIRTH'];
					$_SESSION['update-prescription-gender'] = $row2['GENDER'];
					$_SESSION['update-prescription-id-num'] = $row2['ID_NUMBER'];
				}	
			}
			$_SESSION['update-prescription-id'] = $row['PRESCRIPTION_ID'];
			$_SESSION['update-prescription-date'] = $row['PRESCRIPTION_DATE'];

			$sql3 = "SELECT * FROM DISEASE WHERE DISEASE_ID = '".$row['DISEASE_ID']."'";
			$result3 = mysqli_query($conn, $sql3);
			$resultCheck3 = mysqli_num_rows($result3);
			if($resultCheck3 > 0){
				if ($row3 = mysqli_fetch_assoc($result3)) {
					$_SESSION['update-prescription-disease'] = $row3['DISEASE_ID']." - ".$row3['NAME'];
				}	
			}

			$sql4 = "SELECT * FROM MEDICATION WHERE MED_ID = '".$row['MED_ID']."'";
			$result4 = mysqli_query($conn, $sql4);
			$resultCheck4 = mysqli_num_rows($result4);
			if($resultCheck4 > 0){
				if ($row4 = mysqli_fetch_assoc($result4)) {
					$_SESSION['update-prescription-medication'] = $row4['MED_ID']." - ".$row4['NAME'];
				}	
			}

			$_SESSION['update-prescription-dosage'] = $row['DOSAGE_FORM'];
			$_SESSION['update-prescription-schedule'] = $row['SCHEDULE'];

			$sql5 = "SELECT * FROM ACTIVE_INGREDIENT WHERE PRESCRIPTION_ID = '".$row['PRESCRIPTION_ID']."' AND INGREDIENT_ID = '".$row['INGREDIENT_ID']."'";
			$result5 = mysqli_query($conn, $sql5);
			$resultCheck5 = mysqli_num_rows($result5);
			if($resultCheck5 > 0){
				if ($row5 = mysqli_fetch_assoc($result5)) {
					$_SESSION['update-prescription-act-ingredients'] = $row5['NAME'];
				}	
			}

			$_SESSION['update-prescription-quantity'] = $row['QUANTITY'];
			$_SESSION['update-prescription-repeats'] = $row['CURRENT_REPEATS'];
			$_SESSION['update-prescription-status'] = $row['STATUS'];
			$_SESSION['update-prescription-instructions'] = $row['INSTRUCTIONS'];
			$_SESSION['update-prescription-ingredient-id'] = $row['INGREDIENT_ID'];
			
			header("Location: ../doctor-update-prescriptions.php?prescription-search=success");
			mysqli_close($conn);
			exit();
		}
	}
}else{
	header("Location: ../index.php.php?search-prescription=error");
	session_unset();
	session_destroy();
	mysqli_close($conn);
	exit();
}