<?php 

	if ($_SESSION['med_history_id_num'] == "") {
		echo("<script>alert('Capture Medical History Unsuccessful: Patient personal details are empty.')</script>");
	 	echo("<script>window.location = 'doctor-home.php?capture-medical-history=error';</script>");
	 	echo $_SESSION['med_history_id_num'];
		exit();
	}

	echo '<h2>'.$_SESSION['med-history-name'].' '.$_SESSION['med-history-surname'].' Prescription Details</h2>';

	echo '
	<div class="table-container">
		<table id="myTable">
			<tr>
				<th>No</th>
	      		<th>Prescription&nbsp;Date</th>
		      	<th>Medication&nbsp;Name</th>
		      	<th>Quantity</th>
		      	<th>Repeats</th>
		      	<th>Instructions</th>
		      	<th>Status</th>
		      	<th>Update&nbsp;Prescription</th>
	    	</tr>';

    include 'php/data-connection.php';
	$count_rows = 1;

	$sql1 = "SELECT * FROM PRESCRIPTION WHERE PATIENT_ID ='".$_SESSION['med_history_id_num']."' AND NOT STATUS='Unconfirmed' AND NOT STATUS='DISPENSED' ORDER BY PRESCRIPTION_DATE DESC";
	$result1 = mysqli_query($conn, $sql1);
	$resultCheck1 = mysqli_num_rows($result1);
	if($resultCheck1 > 0){

		while ($row1 = mysqli_fetch_assoc($result1)) {
			$_SESSION['view_prescription_id'] = $row1['PRESCRIPTION_ID'];
			$_SESSION['view_prescription_repeats'] = $row1['CURRENT_REPEATS'];

			echo '<form method="POST" enctype="multipart/form-data" autocomplete="off" style="width: 100%;">';
			echo '<tr>
					<td>'.$count_rows++.'</td>
					<td>
					<input type="date" name="prescription_date" id="prescription_date" value="'.$row1['PRESCRIPTION_DATE'].'" max="'.date("Y-m-d").'" required style="min-width: 110px;">
					</td>';

			$sql4 = "SELECT * FROM MEDICATION WHERE MED_ID = '".$row1['MED_ID']."'";
			$result4 = mysqli_query($conn, $sql4);
			$resultCheck4 = mysqli_num_rows($result4);
			if($resultCheck4 > 0){
				if ($row4 = mysqli_fetch_assoc($result4)) {
					$_SESSION['view_pre_med_name'] = $row4['NAME'];
					$_SESSION['view_pre_med_id'] = $row4['MED_ID'];
					echo '<td>';

					$sql5 = "SELECT * FROM MEDICATION ORDER BY NAME";
					$result5 = mysqli_query($conn, $sql5);
					$resultCheck5 = mysqli_num_rows($result5);
					if($resultCheck5 > 0){
						echo '
						<select name="medication" id="medication">
						<option value="'.$_SESSION['view_pre_med_id'].' - '.$_SESSION['view_pre_med_name'].'" selected>'.$_SESSION['view_pre_med_name'].'</option>';

						while ($row5 = mysqli_fetch_assoc($result5)) {

							$ingredient = "";
							$sql6 = "SELECT * FROM ACTIVE_INGREDIENT WHERE MED_ID = '".$row5['MED_ID']."'";
							$result6 = mysqli_query($conn, $sql6);
							$resultCheck6 = mysqli_num_rows($result6);
							if($resultCheck6 > 0){
								while ($row6 = mysqli_fetch_assoc($result6)) {
									$ingredient .= ' | '.$row6['NAME'].' '.$row6['STRENGTH'];
								}
							}
							echo '<option value="'.$row5['MED_ID'].' - '.$row5['NAME'].'" title="S'.$row5['SCHEDULE'].' | '.$row5['DOSAGE_FORM'].' '.$ingredient.'">'.$row5['NAME'].'</option>';	
						}
						
						echo '</select>';
					}else{
						echo '
						<select name="medication"  id="medication" placeholder="No medication available" disabled>
						<option selected disabled>No medication available</option>
						</select><br>';
					}
					echo '</td>';
				}	
			}

			echo '<td>
			<input type="number" name="quantity" id="quantity" min="1" value="'.$row1['QUANTITY'].'" required style="min-width: 50px;">
			</td>';
			echo '<td>
			<input type="number" name="repeats" id="repeats" min="1" value="'.$_SESSION['view_prescription_repeats'].'" required style="min-width: 50px;">
			</td>';
			echo '<td>
			<input type="text" name="instructions" id="instructions" value="'.$row1['INSTRUCTIONS'].'" required>
			</td>';
			echo '<td>'.$row1['STATUS'].'</td>';

			
			echo '<td><button type="submit" name="btnUpdate" id="btnSelect" formaction="php/data-doctor-update-prescriptions.php?prescription_id='.$_SESSION['view_prescription_id'].'">Update</button></td>';
			echo '</tr>';
			echo '</form>';							
		}	
	}else{
		echo '<tr><td colspan ="17" style="text-align: center;">No Prescription Available</td></tr>';
	}
  	echo '</table>
  	</div>';
  	mysqli_close($conn);
?>