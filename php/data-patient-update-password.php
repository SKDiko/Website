<?php

if (isset($_POST['btnResetPass'])) {
	require 'data-connection.php';
	$selector =  mysqli_real_escape_string($conn, $_POST['selector']);
	$validator = mysqli_real_escape_string($conn, $_POST['validator']);
	$confirm_pswd = mysqli_real_escape_string($conn, $_POST['confirm_pswd']);
	$currentDate = date("U");

	$sql = "SELECT * FROM RESET_PASSWORD WHERE SELECTOR_TOKEN = ?";
	if($stmt = mysqli_prepare($conn, $sql)){
		mysqli_stmt_bind_param($stmt, "s", $selector);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if ($row = mysqli_fetch_assoc($result)){
			$tokenBin = hex2bin($validator);
			$tokenCheck = password_verify($tokenBin, $row["VALIDATOR_TOKEN"]);
			if($tokenCheck == true){
				$userName = $row['USERNAME'];
				$userEmail = $row['EMAIL'];
				$date_token = $row['TIME_TOKEN'];

				if ($currentDate >= $date_token){
					echo("<script>alert('Reset Password Unsuccessful: Password reset time have expired.')</script>");
				 	echo("<script>window.location = '../patient-reset-password.php?reset-password=error';</script>");
				 	mysqli_close($conn);
					exit();
				}

				$sql = "SELECT * FROM PATIENT WHERE ID_NUMBER = ? AND EMAIL = ?;";
				if($stmt = mysqli_prepare($conn, $sql)){
					mysqli_stmt_bind_param($stmt, "ss", $userName, $userEmail);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					if ($row = mysqli_fetch_assoc($result)){

						$sql = "DELETE FROM RESET_PASSWORD WHERE USERNAME = ? AND EMAIL = ?;";
						if(mysqli_stmt_prepare($stmt, $sql)){
							mysqli_stmt_bind_param($stmt, "ss", $userName, $userEmail);
							mysqli_stmt_execute($stmt);

							$sql = "UPDATE PATIENT SET PASSWORD = ? WHERE ID_NUMBER = ? AND EMAIL = ?;";
							if(mysqli_stmt_prepare($stmt, $sql)){
								mysqli_stmt_bind_param($stmt, "sss", $confirm_pswd, $userName, $userEmail);
								mysqli_stmt_execute($stmt);
								mysqli_stmt_close($stmt);
								echo("<script>alert('Patient Password Reset Successful')</script>");
								echo("<script>window.location = '../index.php?reset-password=success';</script>");
								mysqli_close($conn);
								exit();
							}else{
								echo("<script>alert('Reset Password Unsuccessful: Something went wrong, Please try again.')</script>");
	 							echo("<script>window.location = '../patient-reset-password.php?reset-password=error';</script>");
							 	mysqli_close($conn);
								exit();
							}
						}else{
							echo("<script>alert('Reset Password Unsuccessful: Something went wrong, Please try again.')</script>");
	 						echo("<script>window.location = '../patient-reset-password.php?reset-password=error';</script>");
							mysqli_close($conn);
							exit();
						}
					}else{
						echo("<script>alert('Reset Password Unsuccessful: Something went wrong, Please try again.')</script>");
	 					echo("<script>window.location = '../patient-reset-password.php?reset-password=error';</script>");
					 	mysqli_close($conn);
						exit();
					}
				}else{
					echo("<script>alert('Reset Password Unsuccessful: Something went wrong, Please try again.')</script>");
	 				echo("<script>window.location = '../patient-reset-password.php?reset-password=error';</script>");
				 	mysqli_close($conn);
					exit();
				}
			}else{
				echo("<script>alert('Reset Password Unsuccessful: Something went wrong, Please try again.')</script>");
	 			echo("<script>window.location = '../patient-reset-password.php?reset-password=error';</script>");
			 	mysqli_close($conn);
				exit();
			}
		}else{
			echo("<script>alert('Reset Password Unsuccessful: Something went wrong, Please try again.')</script>");
	 		echo("<script>window.location = '../patient-reset-password.php?reset-password=error';</script>");
		 	mysqli_close($conn);
			exit();
		}
	}else{
		echo("<script>alert('Reset Password Unsuccessful: Something went wrong, Please try again.')</script>");
	 	echo("<script>window.location = '../patient-reset-password.php?reset-password=error';</script>");
	 	mysqli_close($conn);
		exit();
	}

}else{
	header("Location: ../patient-reset-password.php?reset-password=error");
	exit();
}