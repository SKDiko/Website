<?php
	include 'php/data-connection.php';

	$sql = "SELECT * FROM MEDICATION ORDER BY NAME";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		echo '
		<label for="medication">Medication Name:</label><br>
		<input list="medication" name="medication" class="data-list" autofocus required>
		<datalist id="medication">';

		$count = -1;
		$arr = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$count++;
			$arr[$count] = $row['NAME'];
		}
		$arr = array_unique($arr);

		foreach($arr as $x => $x_value) {
			echo '<option value="'.$arr[$x].'"></option>';
		}
		echo '</datalist>';
	}else{
		echo '
		<label for="medication">Medication Name:</label><br>
		<select name="medication"  id="medication" placeholder="No medication available" disabled>
		<option selected disabled>No medication available</option>
		</select><br>';
	}

	mysqli_close($conn);
?>