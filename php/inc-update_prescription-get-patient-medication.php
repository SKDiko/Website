<?php
	include 'data-connection.php';

	$sql1 = "SELECT MED_ID FROM DISEASE WHERE DISEASE_ID = '".substr($_SESSION['selected_disease'], 0, 6)."'";
	$result1 = mysqli_query($conn, $sql1);
	$resultCheck1 = mysqli_num_rows($result1);
	if($resultCheck1 > 0){
		echo '
		<label for="medication">Medication Name:</label><br>
		<select name="medication" id="medication">
		<option value="'.$_SESSION['update_prescription_medication'].'" selected>'.substr($_SESSION['update_prescription_medication'], 10).'</option>';

		while ($row1 = mysqli_fetch_assoc($result1)) {
			$sql2 = "SELECT * FROM MEDICATION WHERE MED_ID = '".$row1['MED_ID']."'";
			$result2 = mysqli_query($conn, $sql2);
			$resultCheck2 = mysqli_num_rows($result2);
			if($resultCheck2 > 0){
				while ($row2 = mysqli_fetch_assoc($result2)) {
					echo '<option value="'.$row2['MED_ID'].' - '.$row2['NAME'].'">'.$row2['NAME'].'</option>';
				}	
			}
		}
		echo '</select><br>';	
	}else{
		echo '
		<label for="medication">Medication Name:</label><br>
		<select name="medication"  id="medication" placeholder="No Medication available" disabled>
		<option selected disabled>No Medication available</option>
		</select><br>';
	}
	
	mysqli_close($conn);
?>