<?php
	include 'data-connection.php';

	$sql = "SELECT ALLERGY_ID, NAME FROM ALLERGY ORDER BY NAME";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		echo '
		<label for="allergy_name">Allergy Name:</label><br>
		<select name="allergy_name" id="allergy_name">
		<option selected disabled></option>';
		$count = -1;
		$arr = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$count++;
			$arr[$count] = $row['ALLERGY_ID'].' - '.$row['NAME'];
		}
		$arr = array_unique($arr);

		foreach($arr as $x => $x_value) {
			echo '<option value="'.$arr[$x].'">'.substr($arr[$x], 10).'</option>';
		}
		echo '</select><br>';
	}else{
		echo '
		<label for="allergy_name">Allergy Name:</label><br>
		<select name="allergy_name" id="allergy_name" placeholder="No Allergy available" disabled>
		<option selected disabled>No Allergy available</option>
		</select><br>';

	}

	mysqli_close($conn);
?>