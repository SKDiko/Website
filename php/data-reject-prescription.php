<?php
session_start();

if (isset($_GET['reject-reason'])) {

	include_once 'data-connection.php'; 

	$reason = mysqli_real_escape_string($conn, $_GET['reject-reason']);
	$pharm = mysqli_real_escape_string($conn, $_SESSION['pharm_reg_num']);
	$prescription_id = mysqli_real_escape_string($conn, $_SESSION['dispense_prescription_id']);

	//send email
	$to = $_SESSION['dispense_doc_email'];
	
	$subject = 'Prescription Rejected';
	$message = '<p>Dear Dr. '.$_SESSION['dispense_doc_name'].' '.$_SESSION['dispense_doc_surname'].'</p>';
	$message .='<p>Your Prescription:<br>';
	$message .='ID: '.$prescription_id.'<br>';
	$message .='Name: '.$_SESSION['dispense_prescription_medication'].'<br>';
	$message .='Date: '.$_SESSION['dispense_prescription_date'].'</p>';
	$message .='<p>Have been rejected by pharmacist:<br>';
	$message .='Name: '.$_SESSION['pharm_surname'].' '.$_SESSION['pharm_name'].'<br>';
	$message .='Contact Number: '.$_SESSION['pharm_contact_num'].'<br>';
	$message .='Email: '.$_SESSION['pharm_email'].'</p>';
	
	$message .='<p>Rejection Reason: '.$reason.'<br>';
	$message .='Rejection Date: '.date("Y-m-d").'</p>';
    
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
				$_SESSION['dispense-pat-id-num'] = "";
				$_SESSION['dispense-pat-name'] = "";
				$_SESSION['dispense-pat-surname'] = "";
				$_SESSION['dispense-pat-birth'] = "";
				$_SESSION['dispense-pat-gender'] = "";
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
			
		  		echo("<script>alert('Reject Prescription Successful')</script>");
		  		echo("<script>window.location = '../pharmacist-dispense-prescription.php?reject-prescription=success';</script>");
		 		mysqli_close($conn);
				exit();
			} else {
		 		echo("<script>alert('Reject Prescription Reason Unsuccessful: Something went wrong, please try again.')</script>");
		 		echo("<script>window.location = '../pharmacist-dispense-prescription.php?reject-prescription=error';</script>");
		 		mysqli_close($conn);
				exit(); 
			} 
		} else {
	 		echo("<script>alert('Reject Prescription Unsuccessful: Something went wrong, Please try again.')</script>");
	 		echo("<script>window.location = '../pharmacist-dispense-prescription.php?reject-prescription=error';</script>");
	 		mysqli_close($conn);
			exit(); 
		}
    }else{
   	  	echo("<script>alert('Reject Prescription Unsuccessful: Sorry something went wrong, unable to send email. Please check your internet connection.')</script>");
   	  	echo("<script>window.location = '../pharmacist-dispense-prescription.php?reject-prescription=error';</script>");
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