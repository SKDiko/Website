<?php
	include 'data-connection.php';
	$count_rows = 1;
	$GLOBALS['view_pre_pat_name'] ="";

	$sql = "SELECT * FROM PATIENT WHERE ID_NUMBER= '".$_SESSION['view_prescriptions_pat_id_num']."'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		if ($row = mysqli_fetch_assoc($result)) {
			$GLOBALS['view_pre_pat_name'] = $row['NAME']." ".$row['SURNAME'];		
		}	
	}

echo '
<div class="table-container">
	<table id="myTable">
		<caption><b>'.$GLOBALS['view_pre_pat_name'].' Prescription Details</b></caption>
		<tr>
			<th><button onclick="sortTable(0, true)">No&nbsp;&#8645;</button></th>
			<th>Dispense&nbsp;Date</th>
      		<th><button onclick="sortTable(2, false)">Prescription&nbsp;Date&nbsp;&#8645;</button></th>
      		<th><button onclick="sortTable(3, false)">Doctor&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(4, false)">Medication&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(5, false)">Dosage&nbsp;Form&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(6, true)">Quantity&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(7, true)">Repeats&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(8, false)">Instructions&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(9, false)">Status&nbsp;&#8645;</button></th>
	      	<th><button>Dispense&nbsp;Prescription</button></th>
	      	<th><button>View&nbsp;Prescription</button></th>
	      	<th><button>Reject&nbsp;Prescription</button></th>
    	</tr>';

	$sql1 = "SELECT * FROM PRESCRIPTION WHERE PATIENT_ID ='".$_SESSION['view_prescriptions_pat_id_num']."' AND NOT STATUS='Unconfirmed' ORDER BY PRESCRIPTION_DATE DESC";
	$result1 = mysqli_query($conn, $sql1);
	$resultCheck1 = mysqli_num_rows($result1);
	if($resultCheck1 > 0){

		while ($row1 = mysqli_fetch_assoc($result1)) {
			$_SESSION['view_prescription_id'] = $row1['PRESCRIPTION_ID'];
			$_SESSION['view_prescription_repeats'] = $row1['CURRENT_REPEATS'];
			$_SESSION['view_prescription_status'] = $row1['STATUS'];
			$_SESSION['view_prescription_doc_id'] = $row1['DOCTOR_ID'];

			echo '<form method="POST" enctype="multipart/form-data" autocomplete="on">';
			echo '<tr>
					<td>'.$count_rows++.'</td>
					<td>
					<input type="date" name="dispense_date" id="dispense_date" value="'.date("Y-m-d").'" max="'.date("Y-m-d").'" required style="min-width: 110px;">
					</td>
					<td>'.$row1['PRESCRIPTION_DATE'].'</td>';


        	$sql2 = "SELECT * FROM DOCTOR WHERE REGISTRATION_NUM = '".$row1['DOCTOR_ID']."'";
			$result2 = mysqli_query($conn, $sql2);
			$resultCheck2 = mysqli_num_rows($result2);
			if($resultCheck2 > 0){
				if ($row2 = mysqli_fetch_assoc($result2)) {
					echo '<td>'.$row2['NAME'].' '.$row2['SURNAME'].'</td>';
				}	
			}

			$sql4 = "SELECT * FROM MEDICATION WHERE MED_ID = '".$row1['MED_ID']."'";
			$result4 = mysqli_query($conn, $sql4);
			$resultCheck4 = mysqli_num_rows($result4);
			if($resultCheck4 > 0){
				if ($row4 = mysqli_fetch_assoc($result4)) {
					$_SESSION['view_pre_med_id'] = $row4['MED_ID'];
					$_SESSION['view_pre_med_name'] = $row4['NAME'];
					echo '<td>'.$_SESSION['view_pre_med_name'].'</td>';
					echo '<td>'.$row4['DOSAGE_FORM'].'</td>';
				}	
			}

			$sql6 = "SELECT * FROM DISPENSE_PRESCRIPTION WHERE PRESCRIPTION_ID = '".$_SESSION['view_prescription_id']."' ORDER BY DISPENSE_DATE DESC";
			$result6 = mysqli_query($conn, $sql6);
			$resultCheck6 = mysqli_num_rows($result6);
			if($resultCheck6 > 0){
				if ($row6 = mysqli_fetch_assoc($result6)) {
					$_SESSION['dispense-pre-latest-date'] = $row6['DISPENSE_DATE'];
				}	
			} else {
				$_SESSION['dispense-pre-latest-date'] = "None";
			}

			
			echo '<td>'.$row1['QUANTITY'].'</td>';
			echo '<td>'.$_SESSION['view_prescription_repeats'].'</td>';
			echo '<td>'.$row1['INSTRUCTIONS'].'</td>';
			echo '<td>'.$row1['STATUS'].'</td>';

			echo '<td><button type="submit" name="btnDispense" id="btnSelect" formaction="php/data-pharmacist-dispense-prescription.php?prescription_id='.$_SESSION['view_prescription_id'].'&repeats='.$_SESSION['view_prescription_repeats'].'&status='.$_SESSION['view_prescription_status'].'&dispense-latest-date='.$_SESSION['dispense-pre-latest-date'].'&med_name='.$_SESSION['view_pre_med_name'].'&med_id='.$_SESSION['view_pre_med_id'].'&allergy_checked=no&med_interaction_checked=no&med_contraindication_checked=no&dispense_days_checked=no">Dispense</button></td>';
			echo '<td><button type="submit" name="btnView" id="btnSelect" formaction="php/data-pharmacist-dispense-prescription.php?prescription_id='.$_SESSION['view_prescription_id'].'&status='.$_SESSION['view_prescription_status'].'&med_name='.$_SESSION['view_pre_med_name'].'">View</button></td>';
			echo '<td><button type="submit" name="btnReject" id="btnSelect" formaction="php/data-pharmacist-dispense-prescription.php?prescription_id='.$_SESSION['view_prescription_id'].'&repeats='.$_SESSION['view_prescription_repeats'].'&status='.$_SESSION['view_prescription_status'].'&med_name='.$_SESSION['view_pre_med_name'].'&doc_id='.$_SESSION['view_prescription_doc_id'].'">Reject</button></td>';
			echo '</form>';
			echo '</tr>';							
		}	
	}else{
		echo '<tr><td colspan ="17" style="text-align: center;">No Prescription Available</td></tr>';
	}
  	echo '</table>
  	</div>';
  	mysqli_close($conn);
?>