<?php
echo '
<div class="table-container">
	<table id="myTable">
		<tr>
			<th><button onclick="sortTable(0, true)">No&nbsp;&#8645;</button></th>
      		<th><button onclick="sortTable(1, false)">Prescription&nbsp;Date&nbsp;&#8645;</button></th>
      		<th><button onclick="sortTable(2, false)">Doctor&nbsp;&#8645;</button></th>
      		<th><button onclick="sortTable(3, false)">Medical&nbsp;Practice&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(4, false)">Medication&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(5, false)">Dosage&nbsp;Form&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(6, false)">Schedule&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(7, false)">Active&nbsp;Ingredients&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(8, true)">Quantity&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(9, true)">Original&nbsp;Repeats&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(10, true)">Repeats&nbsp;Left&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(11, false)">Instructions&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(12, false)">Status&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(13, false)">Dispense&nbsp;Date&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(14, false)">Pharmacist&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(15, false)">Pharmacy&nbsp;&#8645;</button></th>
	      	<th><button>View&nbsp;Dispense</button></th>
    	</tr>';

	include 'php/data-connection.php';
	$count_rows = 1;

	$sql1 = "SELECT * FROM PRESCRIPTION WHERE PATIENT_ID ='".$_SESSION['pat_id_num']."' AND NOT STATUS='Unconfirmed' ORDER BY PRESCRIPTION_DATE DESC";
	$result1 = mysqli_query($conn, $sql1);
	$resultCheck1 = mysqli_num_rows($result1);
	if($resultCheck1 > 0){

		while ($row1 = mysqli_fetch_assoc($result1)) {
			$GLOBALS['view_prescription_id'] = $row1['PRESCRIPTION_ID'];
			$GLOBALS['view_prescription_status'] = $row1['STATUS'];

			echo '<tr>
					<td>'.$count_rows++.'</td>
					<td>'.$row1['PRESCRIPTION_DATE'].'</td>';

        	$sql2 = "SELECT * FROM DOCTOR WHERE REGISTRATION_NUM = '".$row1['DOCTOR_ID']."'";
			$result2 = mysqli_query($conn, $sql2);
			$resultCheck2 = mysqli_num_rows($result2);
			if($resultCheck2 > 0){
				if ($row2 = mysqli_fetch_assoc($result2)) {
					echo '<td>'.$row2['NAME'].' '.$row2['SURNAME'].'</td>';

					$sql7 = "SELECT * FROM MEDICAL_PRACTICE WHERE PRACTICE_NUM = '".$row2['PRACTICE_NUM']."'";
					$result7 = mysqli_query($conn, $sql7);
					$resultCheck7 = mysqli_num_rows($result7);
					if($resultCheck7 > 0){
						if ($row7 = mysqli_fetch_assoc($result7)) {
							echo '<td>'.$row7['NAME'].'</td>';
						}	
					}
				}	
			}

			$sql4 = "SELECT * FROM MEDICATION WHERE MED_ID = '".$row1['MED_ID']."'";
			$result4 = mysqli_query($conn, $sql4);
			$resultCheck4 = mysqli_num_rows($result4);
			if($resultCheck4 > 0){
				if ($row4 = mysqli_fetch_assoc($result4)) {
					$GLOBALS['view_pre_med_name'] = $row4['NAME'];
					echo '<td>'.$row4['NAME'].'</td>';
					echo '<td>'.$row4['DOSAGE_FORM'].'</td>';
					echo '<td>'.$row4['SCHEDULE'].'</td>';
				}	
			}

            $ingredient = "";
			$sql5 = "SELECT * FROM ACTIVE_INGREDIENT WHERE MED_ID = '".$row1['MED_ID']."'";
			$result5 = mysqli_query($conn, $sql5);
			$resultCheck5 = mysqli_num_rows($result5);
			if($resultCheck5 > 0){
				while ($row5 = mysqli_fetch_assoc($result5)) {
					$ingredient .= $row5['NAME'].': '.$row5['STRENGTH'].'<br>';
				}	
			}
            echo '<td>'.$ingredient.'</td>';
			echo '<td>'.$row1['QUANTITY'].'</td>';
			echo '<td>'.$row1['ORIGINAL_REPEATS'].'</td>';
			echo '<td>'.$row1['CURRENT_REPEATS'].'</td>';
			echo '<td>'.$row1['INSTRUCTIONS'].'</td>';
			echo '<td>'.$row1['STATUS'].'</td>';

			$sql6 = "SELECT * FROM DISPENSE_PRESCRIPTION WHERE PRESCRIPTION_ID = '".$row1['PRESCRIPTION_ID']."' ORDER BY DISPENSE_DATE DESC";
			$result6 = mysqli_query($conn, $sql6);
			$resultCheck6 = mysqli_num_rows($result6);
			if($resultCheck6 > 0){
				if ($row6 = mysqli_fetch_assoc($result6)) {
					echo '<td>'.$row6['DISPENSE_DATE'].'</td>';
					
					$sql8 = "SELECT * FROM PHARMACIST WHERE REGISTRATION_NUM = '".$row6['PHARMACIST_ID']."'";
					$result8 = mysqli_query($conn, $sql8);
					$resultCheck8 = mysqli_num_rows($result8);
					if($resultCheck8 > 0){
						if ($row8 = mysqli_fetch_assoc($result8)) {
							echo '<td>'.$row8['NAME'].' '.$row8['SURNAME'].'</td>';

							$sql9 = "SELECT * FROM PHARMACY WHERE LICENSE_NUM = '".$row8['PHARMACY_ID']."'";
							$result9 = mysqli_query($conn, $sql9);
							$resultCheck9 = mysqli_num_rows($result9);
							if($resultCheck9 > 0){
								if ($row9 = mysqli_fetch_assoc($result9)) {
									echo '<td>'.$row9['NAME'].'</td>';
								}	
							}
						}	
					}
					
				}	
			} else {
				echo '<td>None</td>';
				echo '<td>None</td>';
				echo '<td>None</td>';
			}
			echo '<form method="POST" enctype="multipart/form-data" autocomplete="on">';
			echo '<td><button type="submit" name="btnView" id="btnSelect" formaction="php/data-patient-view-dispense.php?prescription_id='.$GLOBALS['view_prescription_id'].'&status='.$GLOBALS['view_prescription_status'].'&med_name='.$GLOBALS['view_pre_med_name'].'">View</button></td>';
			echo '</form>';
			echo '</tr>';							
		}	
	}else{
		echo '<tr><td colspan ="16" style="text-align: center;">No Prescription Available</td></tr>';
	}
  	echo '</table>
  	</div>';
  	mysqli_close($conn);
?>