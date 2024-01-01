<?php 

if (isset($_POST['btnReset'])) {
	require 'data-connection.php'; 
	$user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
	$hashed_userName = password_hash($user_name, PASSWORD_DEFAULT);
	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);
	$expires = date("U") + 300;

	$sql = "SELECT * FROM PATIENT WHERE ID_NUMBER ='$user_name' OR EMAIL = '$user_name'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck < 1){

		$sql = "SELECT * FROM DOCTOR WHERE REGISTRATION_NUM ='$user_name' OR EMAIL = '$user_name'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck < 1){
			
			$sql = "SELECT * FROM PHARMACIST WHERE REGISTRATION_NUM ='$user_name' OR EMAIL = '$user_name'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck < 1){
				echo'<script>window.alert("Reset Password Unsuccessful: Your username is incorrect.");</script>';
				echo("<script>window.location = '../patient-reset-password.php?reset-password=error';</script>");
		 		mysqli_close($conn);
				exit();
			}else{
				if($row = mysqli_fetch_assoc($result)){
					$GLOBALS['reset_id_num'] = $row['REGISTRATION_NUM'];
					$GLOBALS['reset_name'] = $row['NAME'];
					$GLOBALS['reset_surname'] = $row['SURNAME'];
					$GLOBALS['reset_email'] = $row['EMAIL'];

					$url = "http://localhost/eprescribing-system/pharmacist-create-new-password.php?selector=".$selector."&validator=".bin2hex($token)."&id=".$hashed_userName;
				}
			}

		}else{
			if($row = mysqli_fetch_assoc($result)){
				$GLOBALS['reset_id_num'] = $row['REGISTRATION_NUM'];
				$GLOBALS['reset_name'] = $row['NAME'];
				$GLOBALS['reset_surname'] = $row['SURNAME'];
				$GLOBALS['reset_email'] = $row['EMAIL'];
				
				$url = "http://localhost/eprescribing-system/doctor-create-new-password.php?selector=".$selector."&validator=".bin2hex($token)."&id=".$hashed_userName;
			}
		}
	}else{
		if($row = mysqli_fetch_assoc($result)){
			$GLOBALS['reset_id_num'] = $row['ID_NUMBER'];
			$GLOBALS['reset_name'] = $row['NAME'];
			$GLOBALS['reset_surname'] = $row['SURNAME'];
			$GLOBALS['reset_email'] = $row['EMAIL'];

			$url = "http://localhost/eprescribing-system/patient-create-new-password.php?selector=".$selector."&validator=".bin2hex($token)."&id=".$hashed_userName;
		}
	}

	//delete token
	$sql = "DELETE FROM RESET_PASSWORD WHERE USERNAME=?;";
	if($stmt = mysqli_prepare($conn, $sql)){
		mysqli_stmt_bind_param($stmt, "s", $GLOBALS['reset_id_num']);
		mysqli_stmt_execute($stmt);
	}else{
		echo("<script>alert('Reset Password Unsuccessful: Something went wrong, Please try again.')</script>");
	 	echo("<script>window.location = '../patient-reset-password.php?reset-password=error';</script>");
	 	mysqli_close($conn);
		exit();
	}

	//Check token
	$sql = "SELECT * FROM RESET_PASSWORD WHERE SELECTOR_TOKEN ='$selector'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		echo("<script>alert('Reset Password Unsuccessful: Something went wrong, Please try again.')</script>");
	 	echo("<script>window.location = '../patient-reset-password.php?reset-password=error';</script>");
	 	mysqli_close($conn);
		exit();
	}
    
    //insert token
	$sql = "INSERT INTO RESET_PASSWORD (USERNAME, EMAIL, SELECTOR_TOKEN, VALIDATOR_TOKEN, TIME_TOKEN) VALUES (?, ?, ?, ?, ?);";
	if($stmt = mysqli_prepare($conn, $sql)){
		$hashedToken = password_hash($token, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "sssss", $GLOBALS['reset_id_num'], $GLOBALS['reset_email'], $selector, $hashedToken, $expires);
		mysqli_stmt_execute($stmt);
	}else{
		echo("<script>alert('Reset Password Unsuccessful: Something went wrong, Please try again.')</script>");
	 	echo("<script>window.location = '../patient-reset-password.php?reset-password=error';</script>");
	 	mysqli_close($conn);
		exit();
	}

	//send email
	$to = $GLOBALS['reset_email'];
	
	$subject = 'Reset your password from E-Prescribing System';
	$message = '<p>Dear '.$GLOBALS['reset_name'].' '.$GLOBALS['reset_surname'].' ('.$GLOBALS['reset_id_num'].')';
	$message .='<br>We received your password reset request. Use the link below to reset your password.</p>';
	$message .='<p>Password reset link: ';
	$message .='<a href="'.$url.'">'.$url.'</a></p>';
    
	$header = "From: E-Prescribing System <97masora0411@gmail.com>\r\n";
	$header .= "Reply-To: 97masora0411@gmail.com\r\n";
	$header .= "MIME-Version: 1.0 \r\n";  
   	$header .= "Content-type: text/html;charset=UTF-8 \r\n"; 

   	$result = mail ($to,$subject,$message,$header);  

   	if( $result == true){ 
   	  	echo("<script>alert('Email Sent Successful: Please check your email to reset your password.')</script>");
   	  	echo("<script>window.location = '../index.php?email-sent=success';</script>");
   	  	mysqli_stmt_close($stmt);
		mysqli_close($conn);
		exit(); 
   }else{
   	  	echo("<script>alert('Email Sent Unsuccessful: Sorry something went wrong, unable to send email. Please check your internet connection.')</script>");
   	  	echo("<script>window.location = '../patient-reset-password.php?email-sent=error';</script>");
   	  	mysqli_stmt_close($stmt);
		mysqli_close($conn);
		exit();    
   }
}else{
	header("Location: ../patient-reset-password.php?reset-password=error");
	exit();
}