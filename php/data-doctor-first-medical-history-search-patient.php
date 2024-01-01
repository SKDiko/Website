<?php
session_start();
if (isset($_POST['btnSearch'])) {
	include 'data-connection.php'; 
	$userName = mysqli_real_escape_string($conn, $_POST['id_num']);

	$sql = "SELECT * FROM PATIENT WHERE ID_NUMBER ='$userName'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck < 1){
		$_SESSION['first-visit-id-num'] = "";
		$_SESSION['first-visit-name'] = "";
		$_SESSION['first-visit-surname'] = "";
		$_SESSION['first-visit-birth'] = "";
		$_SESSION['first-visit-gender'] = "";
		$_SESSION['first-visit-street'] = "";
		$_SESSION['first-visit-suburb'] = "";
		$_SESSION['first-visit-town'] = "";
		$_SESSION['first-visit-province'] = "";
		$_SESSION['first-visit-code'] = "";
		$_SESSION['first-visit-contact-num'] = "";
		$_SESSION['first-visit-email'] = "";

		echo("<script>alert('Search Unsuccessful: Patient ID ".$userName." not found, Please try again.')</script>");
		echo("<script>window.location = '../doctor-first-medical-history.php?patient-search=error';</script>");
 		mysqli_close($conn);
		exit();
	}else{
		if($row = mysqli_fetch_assoc($result)){

			$sql1 = "SELECT * FROM ADDRESS WHERE ADDRESS_ID = '".$row['PAT_ADDRESS']."'";
			$result1 = mysqli_query($conn, $sql1);
			$resultCheck1 = mysqli_num_rows($result1);
			if($resultCheck1 > 0){
				if ($row1 = mysqli_fetch_assoc($result1)) {
					$_SESSION['first-visit-id-num'] = $row['ID_NUMBER'];
					$_SESSION['first-visit-name'] = $row['NAME'];
					$_SESSION['first-visit-surname'] = $row['SURNAME'];
					$_SESSION['first-visit-birth'] = $row['DATE_OF_BIRTH'];
					$_SESSION['first-visit-gender'] = $row['GENDER'];
					$_SESSION['first-visit-street'] = $row1['STREET'];
					$_SESSION['first-visit-suburb'] = $row1['SUBURB'];
					$_SESSION['first-visit-town'] = $row1['TOWN'];
					$_SESSION['first-visit-province'] = $row1['PROVINCE'];
					$_SESSION['first-visit-code'] = $row1['CODE'];
					$_SESSION['first-visit-contact-num'] = $row['CONTACT_NUMBER'];
					$_SESSION['first-visit-email'] = $row['EMAIL'];

					header("Location: ../doctor-first-medical-history.php?patient-search=success");
					mysqli_close($conn);
					exit();
				}
			}else{
				echo("<script>alert('Search Unsuccessful: Something went wrong, Please try again.')</script>");
		 		echo("<script>window.location = '../doctor-first-medical-history.php?patient-search=error';</script>");
		 		mysqli_close($conn);
				exit();
			}
			
		}
	}
}else{
	header("Location: ../index.php?patient-search=error");
	session_unset();
	session_destroy();
	mysqli_close($conn);
	exit();
}