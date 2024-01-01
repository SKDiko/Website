<?php
	include 'data-connection.php';

	$sql5 = "SELECT * FROM MEDICATION ORDER BY NAME";
	$result5 = mysqli_query($conn, $sql5);
	$resultCheck5 = mysqli_num_rows($result5);
	if($resultCheck5 > 0){
		echo '
		<label for="medication">Medication Name:</label><br>
		<select name="medication" id="medication">
		<option selected disabled></option>';

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
		echo '</select><br>';
	}else{
		echo '
		<label for="medication">Medication Name:</label><br>
		<select name="medication"  id="medication" placeholder="No medication available" disabled>
		<option selected disabled>No medication available</option>
		</select><br>';
	}

	mysqli_close($conn);
?>