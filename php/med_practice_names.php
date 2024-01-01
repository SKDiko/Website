<?php
	include 'data-connection.php';
	$sql = "SELECT * FROM MEDICAL_PRACTICE ORDER BY NAME ASC";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		while ($row = mysqli_fetch_assoc($result)) {
			echo '<option value="'.$row['PRACTICE_NUM'].'">'.$row['NAME'].'</option>';
		}
	}else{
		echo '<option selected value="No Medical Practice Available" disabled>';
	}
	mysqli_close($conn);
?>