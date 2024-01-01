<?php
	include 'data-connection.php';

	$sql = "SELECT DISEASE_ID, NAME FROM DISEASE ORDER BY NAME";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		echo '
		<label for="disease_name">Disease Name:</label><br>
		<select name="disease_name" id="disease_name">
		<option selected disabled></option>';

		$count = -1;
		$arr = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$count++;
			$arr[$count] = $row['DISEASE_ID'].' - '.$row['NAME'];
		}
		$arr = array_unique($arr);

		foreach($arr as $x => $x_value) {
			echo '<option value="'.$arr[$x].'">'.substr($arr[$x], 9).'</option>';
		}
		echo '</select><br>';
	}else{
		echo '
		<label for="disease_name">Disease Name:</label><br>
		<select name="disease_name"  id="disease_name" placeholder="No Disease available" disabled>
		<option selected disabled>No Disease available</option>
		</select><br>';
	}

	mysqli_close($conn);
?>