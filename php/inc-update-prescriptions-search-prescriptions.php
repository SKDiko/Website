<?php
	include 'data-connection.php';
	$sql1 = "SELECT * FROM PRESCRIPTION WHERE NOT STATUS = 'Dispensed' ORDER BY PRESCRIPTION_DATE DESC";
	$result1 = mysqli_query($conn, $sql1);
	$resultCheck1 = mysqli_num_rows($result1);
	if($resultCheck1 > 0){
		echo '
		<label for="prescription_id">Prescription ID:</label><br>
		<input list="prescription_id" name="prescription_id" class="data-list" autofocus required>
		<datalist id="prescription_id">';
		while ($row1 = mysqli_fetch_assoc($result1)) {
			$sql2 = "SELECT * FROM MEDICATION WHERE MED_ID = '".$row1['MED_ID']."'";
			$result2 = mysqli_query($conn, $sql2);
			$resultCheck2 = mysqli_num_rows($result2);
			if($resultCheck2 > 0){
				if ($row2 = mysqli_fetch_assoc($result2)) {
					echo '<option value="'.$row1['PRESCRIPTION_ID'].' - '.$row2['NAME'].'">';
				}	
			}
		}
		echo '
		</datalist>
		';
	}else{
		echo '
		<label for="prescription_id">Prescription ID:</label><br>
		<input list="prescription_id" name="prescription_id" class="data-list" placeholder="No Prescription Available" disabled required>
		<datalist id="prescription_id">
		<option value="No Prescription Available" disabled>
		</datalist>';
	}
	mysqli_close($conn);
?>