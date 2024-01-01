<?php
session_start();
//Security: Avoid people login illegal
if (isset($_POST['btnLogin'])) {
	//Get database connection
	include 'data-connection.php';

	$user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
	$pswd = mysqli_real_escape_string($conn, $_POST['pswd']);
		
	$sql = "SELECT * FROM PATIENT WHERE ID_NUMBER ='$user_name' OR EMAIL='$user_name'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck < 1){
		
		$sql = "SELECT * FROM DOCTOR WHERE REGISTRATION_NUM ='$user_name' OR EMAIL='$user_name'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck < 1){
			
			$sql = "SELECT * FROM PHARMACIST WHERE REGISTRATION_NUM ='$user_name' OR EMAIL='$user_name'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck < 1){
				echo'<script>window.alert("Login Unsuccessful: Username or password you entered is incorrect, Please try again.");</script>';
				echo("<script>window.location = '../index.php?login=error';</script>");
		 		mysqli_close($conn);
				exit();

			}else{
				if($row = mysqli_fetch_assoc($result)){
					if ($pswd == $row['PASSWORD']){

						$sql1 = "SELECT * FROM PHARMACY WHERE LICENSE_NUM = '".$row['PHARMACY_ID']."'";
						$result1 = mysqli_query($conn, $sql1);
						$resultCheck1 = mysqli_num_rows($result1);
						if($resultCheck1 > 0){
							if ($row1 = mysqli_fetch_assoc($result1)) {
								
								$sql2 = "SELECT * FROM ADDRESS WHERE ADDRESS_ID = '".$row1['PHARM_ADDRESS']."'";
								$result2 = mysqli_query($conn, $sql2);
								$resultCheck2 = mysqli_num_rows($result2);
								if($resultCheck2 > 0){
									if ($row2 = mysqli_fetch_assoc($result2)) {
										$_SESSION['pharm_reg_num'] = $row['REGISTRATION_NUM'];
										$_SESSION['pharm_name'] = $row['NAME'];
										$_SESSION['pharm_surname'] = $row['SURNAME'];
										$_SESSION['pharm_contact_num'] = $row['CONTACT_NUMBER'];
										$_SESSION['pharm_alt_num'] = $row['ALT_CONTACT_NUMBER'];
										$_SESSION['pharm_email'] = $row['EMAIL'];
										$_SESSION['pharm_pharmacy_id'] = $row['PHARMACY_ID'];
										$_SESSION['pharm_password'] = $row['PASSWORD'];

										$_SESSION['pharmacy_name'] = $row1['NAME'];
										$_SESSION['pharmacy_address'] = $row1['PHARM_ADDRESS'];
										$_SESSION['pharmacy_contact_num'] = $row1['CONTACT_NUMBER'];
										$_SESSION['pharmacy_email'] = $row1['EMAIL'];

										$_SESSION['pharmacy_line1'] = $row2['LINE1'];
										$_SESSION['pharmacy_line2'] = $row2['LINE2'];
										$_SESSION['pharmacy_suburb'] = $row2['SUBURB'];
										$_SESSION['pharmacy_town'] = $row2['TOWN'];
										$_SESSION['pharmacy_province'] = $row2['PROVINCE'];
										$_SESSION['pharmacy_code'] = $row2['CODE'];

										header("Location: ../pharmacist-view-prescriptions.php?login=success");
										mysqli_close($conn);
										exit();
									}

								}else{
									echo("<script>alert('Login Unsuccessful:33 Something went wrong, Please try again.')</script>");
						 			echo("<script>window.location = '../index.php?login=error';</script>");
						 			mysqli_close($conn);
									exit();
								}

							}
						}else{
							echo("<script>alert('Login Unsuccessful: Something went wrong, Please try again.')</script>");
				 			echo("<script>window.location = '../index.php?login=error';</script>");
				 			mysqli_close($conn);
							exit();
						}
					}else{
						echo("<script>alert('Login Unsuccessful: Username or password you entered is incorrect, Please try again.')</script>");
			 			echo("<script>window.location = '../index.php?login=error';</script>");
			 			mysqli_close($conn);
						exit();
					}
				}
			}

		}else{
			if($row = mysqli_fetch_assoc($result)){
				if ($pswd == $row['PASSWORD']){

					$sql1 = "SELECT * FROM MEDICAL_PRACTICE WHERE PRACTICE_NUM = '".$row['PRACTICE_NUM']."'";
					$result1 = mysqli_query($conn, $sql1);
					$resultCheck1 = mysqli_num_rows($result1);
					if($resultCheck1 > 0){
						if ($row1 = mysqli_fetch_assoc($result1)) {
							
							$sql2 = "SELECT * FROM ADDRESS WHERE ADDRESS_ID = '".$row1['PRACTICE_ADDRESS']."'";
							$result2 = mysqli_query($conn, $sql2);
							$resultCheck2 = mysqli_num_rows($result2);
							if($resultCheck2 > 0){
								if ($row2 = mysqli_fetch_assoc($result2)) {
									$_SESSION['doc_reg_num'] = $row['REGISTRATION_NUM'];
									$_SESSION['doc_name'] = $row['NAME'];
									$_SESSION['doc_surname'] = $row['SURNAME'];
									$_SESSION['doc_contact_num'] = $row['CONTACT_NUMBER'];
									$_SESSION['doc_email'] = $row['EMAIL'];
									$_SESSION['doc_qualification'] = $row['QUALIFICATION'];
									$_SESSION['doc_practice_num'] = $row['PRACTICE_NUM'];
									$_SESSION['doc_password'] = $row['PASSWORD'];

									$_SESSION['med_practice_name'] = $row1['NAME'];
									$_SESSION['med_practice_address'] = $row1['PRACTICE_ADDRESS'];
									$_SESSION['med_practice_contact_num'] = $row1['CONTACT_NUMBER'];
									$_SESSION['med_practice_email'] = $row1['EMAIL'];

									$_SESSION['med_practice_line1'] = $row2['LINE1'];
									$_SESSION['med_practice_line2'] = $row2['LINE2'];
									$_SESSION['med_practice_suburb'] = $row2['SUBURB'];
									$_SESSION['med_practice_town'] = $row2['TOWN'];
									$_SESSION['med_practice_province'] = $row2['PROVINCE'];
									$_SESSION['med_practice_code'] = $row2['CODE'];

									header("Location: ../doctor-home.php?login=success");
									mysqli_close($conn);
									exit();
								}

							} else {
								echo("<script>alert('Login Unsuccessful: Something went wrong, Please try again.')</script>");
					 			echo("<script>window.location = '../index.php?login=error';</script>");
					 			mysqli_close($conn);
								exit();
							}

						}
					}else{
						echo("<script>alert('Login Unsuccessful: Something went wrong, Please try again.')</script>");
			 			echo("<script>window.location = '../index.php?login=error';</script>");
			 			mysqli_close($conn);
						exit();
					}

				}else{
					echo("<script>alert('Login Unsuccessful: Username or password you entered is incorrect, Please try again.')</script>");
		 			echo("<script>window.location = '../index.php?login=error';</script>");
		 			mysqli_close($conn);
					exit();
				}
			}
		}

	} else {
		if($row = mysqli_fetch_assoc($result)){
			if ($pswd == $row['PASSWORD']){
				
				$sql1 = "SELECT * FROM ADDRESS WHERE ADDRESS_ID = '".$row['PAT_ADDRESS']."'";
				$result1 = mysqli_query($conn, $sql1);
				$resultCheck1 = mysqli_num_rows($result1);
				if($resultCheck1 > 0){
					if ($row1 = mysqli_fetch_assoc($result1)) {
						$_SESSION['pat_id_num'] = $row['ID_NUMBER'];
						$_SESSION['pat_name'] = $row['NAME'];
						$_SESSION['pat_surname'] = $row['SURNAME'];
						$_SESSION['pat_birth'] = $row['DATE_OF_BIRTH'];
						$_SESSION['pat_gender'] = $row['GENDER'];
						$_SESSION['pat_address'] = $row['PAT_ADDRESS'];
						$_SESSION['pat_contact_num'] = $row['CONTACT_NUMBER'];
						$_SESSION['pat_email'] = $row['EMAIL'];
						$_SESSION['pat_password'] = $row['PASSWORD'];

						$_SESSION['pat_line1'] = $row1['LINE1'];
						$_SESSION['pat_line2'] = $row1['LINE2'];
						$_SESSION['pat_suburb'] = $row1['SUBURB'];
						$_SESSION['pat_town'] = $row1['TOWN'];
						$_SESSION['pat_province'] = $row1['PROVINCE'];
						$_SESSION['pat_code'] = $row1['CODE'];

						header("Location: ../patient-home.php?login=success");
						mysqli_close($conn);
						exit();
					}
				}else{
					echo("<script>alert('Login Unsuccessful: Something went wrong, Please try again.')</script>");
		 			echo("<script>window.location = '../index.php?login=error';</script>");
		 			mysqli_close($conn);
					exit();
				}
				
			} else{
				echo("<script>alert('Login Unsuccessful: Username or password you entered is incorrect, Please try again.')</script>");
	 			echo("<script>window.location = '../index.php?login=error';</script>");
	 			mysqli_close($conn);
				exit();
			}
		}
	}
}else{
	header("Location: ../index.php?login=error");
	session_unset();
	session_destroy();
	mysqli_close($conn);
	exit();
}