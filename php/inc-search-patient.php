<?php
	include 'data-connection.php';
	$sql = "SELECT ID_NUMBER FROM PATIENT";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		echo '
		<label for="id_num">ID Number:</label><br>
		<input list="id_num" name="id_num" class="data-list" pattern="[0-9]{13}" title="ID Number must contain 13 numbers." autofocus required>
		<datalist id="id_num">';
		while ($row = mysqli_fetch_assoc($result)) {
			echo 
			'
			<option value="'.$row['ID_NUMBER'].'">
			';
		}
		echo '
		</datalist>
		';
	}else{
		echo '
		<label for="id_num">ID Number:</label><br>
		<input list="id_num" name="id_num" class="data-list" placeholder="No patients available" disabled required>
		<datalist id="id_num">
		<option value="No patients available" disabled>
		</datalist>';
	}
	mysqli_close($conn);
?>