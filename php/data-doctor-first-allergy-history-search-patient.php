<?php
session_start();
if (isset($_POST['btnSearch'])) {
	include 'data-connection.php'; 
	$userName = mysqli_real_escape_string($conn, $_POST['id_num']);

	$sql = "SELECT * FROM PATIENT WHERE ID_NUMBER ='$userName'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck < 1){
		$_SESSION['med-history-id-num'] = "";
		$_SESSION['med-history-name'] = "";
		$_SESSION['med-history-surname'] = "";
		$_SESSION['med-history-birth'] = "";
		$_SESSION['med-history-gender'] = "";
		$_SESSION['med-history-line1'] = "";
		$_SESSION['med-history-line2'] = "";
		$_SESSION['med-history-suburb'] = "";
		$_SESSION['med-history-town'] = "";
		$_SESSION['med-history-province'] = "";
		$_SESSION['med-history-code'] = "";
		$_SESSION['med-history-contact-num'] = "";
		$_SESSION['med-history-email'] = "";

		echo("<script>alert('Search Unsuccessful: Patient ID ".$userName." not found, Please try again.')</script>");
		echo("<script>window.location = '../doctor-home.php?patient-search=error';</script>");
 		mysqli_close($conn);
		exit();
	}else{
		if($row = mysqli_fetch_assoc($result)){

			$sql1 = "SELECT * FROM ADDRESS WHERE ADDRESS_ID = '".$row['PAT_ADDRESS']."'";
			$result1 = mysqli_query($conn, $sql1);
			$resultCheck1 = mysqli_num_rows($result1);
			if($resultCheck1 > 0){
				if ($row1 = mysqli_fetch_assoc($result1)) {
					$_SESSION['med-history-id-num'] = $row['ID_NUMBER'];
					$_SESSION['med-history-name'] = $row['NAME'];
					$_SESSION['med-history-surname'] = $row['SURNAME'];
					$_SESSION['med-history-birth'] = $row['DATE_OF_BIRTH'];
					$_SESSION['med-history-gender'] = $row['GENDER'];
					$_SESSION['med-history-line1'] = $row1['LINE1'];
					$_SESSION['med-history-line2'] = $row1['LINE2'];
					$_SESSION['med-history-suburb'] = $row1['SUBURB'];
					$_SESSION['med-history-town'] = $row1['TOWN'];
					$_SESSION['med-history-province'] = $row1['PROVINCE'];
					$_SESSION['med-history-code'] = $row1['CODE'];
					$_SESSION['med-history-contact-num'] = $row['CONTACT_NUMBER'];
					$_SESSION['med-history-email'] = $row['EMAIL'];
					echo $row1['TOWN'];;
					header("Location: ../doctor-home.php?patient-search=success");
					mysqli_close($conn);
					exit();
				}
			}else{
				echo("<script>alert('Search Unsuccessful: Something went wrong, Please try again.')</script>");
		 		echo("<script>window.location = '../doctor-home.php?patient-search=error';</script>");
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