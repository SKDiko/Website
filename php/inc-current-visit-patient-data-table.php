<?php
echo '
<div class="table-container">
	<table>
		<tr>
			<th>No</th>
      		<th>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
      		<th>ID&nbsp;Number</th>
      		<th>Patient&nbsp;Name</th>
	      	<th>Patient&nbsp;Age</th>
	      	<th>Patient&nbsp;Gender</th>
	      	<th>Disease&nbsp;Name</th>
	      	<th>Medication&nbsp;Used</th>
    	</tr>';

	include 'data-connection.php';
	$count_rows = 1;

	$sql1 = "SELECT * FROM MED_HISTORY WHERE PATIENT_ID ='".$_SESSION['current_visit_id_num']."' AND NOT DISEASE_ID ='NULL' AND NOT MED_ID ='NULL' ORDER BY MED_DATE DESC";
	$result1 = mysqli_query($conn, $sql1);
	$resultCheck1 = mysqli_num_rows($result1);
	if($resultCheck1 > 0){

		$sql2 = "SELECT * FROM PATIENT WHERE ID_NUMBER = '".$_SESSION['current_visit_id_num']."'";
		$result2 = mysqli_query($conn, $sql2);
		$resultCheck2 = mysqli_num_rows($result2);
		if($resultCheck2 > 0){
			if ($row2 = mysqli_fetch_assoc($result2)) {
				$GLOBALS['current_visit_pat_name'] = $row2['SURNAME']." ". $row2['NAME'];
				$GLOBALS['current_visit_pat_age'] = date("Y") - substr($row2['DATE_OF_BIRTH'], 0, 4);
				$GLOBALS['current_visit_pat_gender'] = $row2['GENDER'];
			}	
		}

		while ($row1 = mysqli_fetch_assoc($result1)) {
			echo '<tr>
					<td>'.$count_rows++.'</td>
					<td>'.$row1['MED_DATE'].'</td>
					<td>'.$row1['PATIENT_ID'].'</td>
					<td>'.$GLOBALS['current_visit_pat_name'].'</td>
					<td>'.$GLOBALS['current_visit_pat_age'].'</td>
					<td>'.$GLOBALS['current_visit_pat_gender'].'</td>';

        	$sql3 = "SELECT * FROM DISEASE WHERE DISEASE_ID = '".$row1['DISEASE_ID']."'";
			$result3 = mysqli_query($conn, $sql3);
			$resultCheck3 = mysqli_num_rows($result3);
			if($resultCheck3 > 0){
				if ($row3 = mysqli_fetch_assoc($result3)) {
					echo '<td>'.$row3['NAME'].'</td>';
				}	
			}

			$sql4 = "SELECT * FROM MEDICATION WHERE MED_ID = '".$row1['MED_ID']."'";
			$result4 = mysqli_query($conn, $sql4);
			$resultCheck4 = mysqli_num_rows($result4);
			if($resultCheck4 > 0){
				if ($row4 = mysqli_fetch_assoc($result4)) {
					echo '<td>'.$row4['NAME'].'</td>';
				}	
			}
			echo '</tr>';							
		}	
	}else{
		echo '<tr><td colspan ="11" style="text-align: center;">Patient Medical History Not Available</td></tr>';
	}
  	echo '</table>
  	</div>';
  	mysqli_close($conn);
?>