<?php
session_start();

if (isset($_GET['reject-reason'])) {

	include_once 'data-connection.php'; 

	$reason = mysqli_real_escape_string($conn, $_GET['reject-reason']);
	$pharm = mysqli_real_escape_string($conn, $_SESSION['pharm_reg_num']);
	$prescription_id = mysqli_real_escape_string($conn, $_GET['prescription_id']);
	$med_name = mysqli_real_escape_string($conn, $_GET['med_name']);
	$pat_id = $_SESSION['view_prescriptions_pat_id_num'];

	$sql2 = "SELECT * FROM DOCTOR WHERE REGISTRATION_NUM = '".$_GET['doc_id']."'";
	$result2 = mysqli_query($conn, $sql2);
	$resultCheck2 = mysqli_num_rows($result2);
	if($resultCheck2 > 0){
		if ($row2 = mysqli_fetch_assoc($result2)) {
			$doc_name = $row2['NAME'].' '.$row2['SURNAME'];
			$doc_email = $row2['EMAIL'];
		}	
	}

	$sql2 = "SELECT * FROM DOCTOR WHERE REGISTRATION_NUM = '".$_GET['doc_id']."'";
	$result2 = mysqli_query($conn, $sql2);
	$resultCheck2 = mysqli_num_rows($result2);
	if($resultCheck2 > 0){
		if ($row2 = mysqli_fetch_assoc($result2)) {
			$doc_name = $row2['NAME'].' '.$row2['SURNAME'];
			$doc_email = $row2['EMAIL'];
		}	
	}

	$sql = "SELECT * FROM PATIENT WHERE ID_NUMBER= '".$pat_id."'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		if ($row = mysqli_fetch_assoc($result)) {		
			$pat_name = $row['NAME']." ".$row['SURNAME'];		
		}	
	}
    
	//send email
	$to = $doc_email;
	
	$subject = 'Prescription Rejected';
	$message = '<p>Dear Dr. '.$doc_name.'</p>';
	$message .='<p>Your Prescription<br>';
	$message .='Name: '.$med_name.'</p>';
	$message .='<p>For Patient<br>';
	$message .='ID: '.$pat_id.'<br>';
	$message .='Name: '.$pat_name.'</p>';
	$message .='<p>Have been rejected by pharmacist<br>';
	$message .='Name: '.$_SESSION['pharm_name'].' '.$_SESSION['pharm_surname'].'<br>';
	$message .='Contact Number: '.$_SESSION['pharm_contact_num'].'<br>';
	$message .='Email: '.$_SESSION['pharm_email'].'</p>';
	
	$message .='<p>Rejection Reason: '.$reason.'<br>';
	$message .='Rejection Date: '.date("Y-m-d").'</p>';
	$message .='<p>Please use this link to update the prescription: <a href="http://localhost/eprescribing-system/">http://localhost/eprescribing-system/</a></p>';
    
	$header = "From: E-Prescribing System <97masora0411@gmail.com>\r\n";
	$header .= "Reply-To: 97masora0411@gmail.com\r\n";
	$header .= "MIME-Version: 1.0 \r\n";  
   	$header .= "Content-type: text/html;charset=UTF-8 \r\n"; 

   	$result = mail ($to,$subject,$message,$header);  

   	if( $result == true){ 

   	  	$sql1 = "INSERT INTO ALERT_MESSAGE (MESSAGE, PHARMACIST_ID, PRESCRIPTION_ID) VALUES ('$reason', '$pharm', '$prescription_id');";
		if (mysqli_query($conn, $sql1)) {

			$sql2 = "UPDATE PRESCRIPTION SET STATUS = 'Rejected' WHERE PRESCRIPTION_ID = '$prescription_id';";
			if (mysqli_query($conn, $sql2)) {
			
		  		echo("<script>alert('Reject Prescription Successful')</script>");
		  		echo("<script>window.location = '../pharmacist-view-prescriptions.php?reject-prescription=success';</script>");
		 		mysqli_close($conn);
				exit();
			} else {
		 		echo("<script>alert('Reject Prescription Reason Unsuccessful: Something went wrong, please try again.')</script>");
		 		echo("<script>window.location = '../pharmacist-view-prescriptions.php?reject-prescription=error';</script>");
		 		mysqli_close($conn);
				exit(); 
			} 
		} else {
	 		echo("<script>alert('Reject Prescription Unsuccessful: Something went wrong, Please try again.')</script>");
	 		echo("<script>window.location = '../pharmacist-view-prescriptions.php?reject-prescription=error';</script>");
	 		mysqli_close($conn);
			exit(); 
		}
    }else{
   	  	echo("<script>alert('Reject Prescription Unsuccessful: Sorry something went wrong, unable to send email. Please check your internet connection.')</script>");
   	  	echo("<script>window.location = '../pharmacist-view-prescriptions.php?reject-prescription=error';</script>");
		mysqli_close($conn);
		exit();    
   }
}else{
	session_unset();
	session_destroy();
	header("Location: ../index.php?reject-prescription=error");
	mysqli_close($conn);
	exit(); 
}