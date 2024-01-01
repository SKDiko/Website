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
	      	<th>Allergy&nbsp;Name</th>
    	</tr>';

	include 'php/data-connection.php';
	$count_rows = 1;

	$sql1 = "SELECT * FROM MED_HISTORY WHERE PATIENT_ID ='".$_SESSION['current_allergy_id_num']."' AND NOT ALLERGY_ID ='NULL' ORDER BY MED_DATE DESC";
	$result1 = mysqli_query($conn, $sql1);
	$resultCheck1 = mysqli_num_rows($result1);
	if($resultCheck1 > 0){

		$sql2 = "SELECT * FROM PATIENT WHERE ID_NUMBER = '".$_SESSION['current_allergy_id_num']."'";
		$result2 = mysqli_query($conn, $sql2);
		$resultCheck2 = mysqli_num_rows($result2);
		if($resultCheck2 > 0){
			if ($row2 = mysqli_fetch_assoc($result2)) {
				$GLOBALS['current_allergy_pat_name'] = $row2['SURNAME']." ". $row2['NAME'];
				$GLOBALS['current_allergy_pat_age'] = date("Y") - substr($row2['DATE_OF_BIRTH'], 0, 4);
				$GLOBALS['current_allergy_pat_gender'] = $row2['GENDER'];
			}	
		}

		while ($row1 = mysqli_fetch_assoc($result1)) {
			echo '<tr>
					<td>'.$count_rows++.'</td>
					<td>'.$row1['MED_DATE'].'</td>
					<td>'.$row1['PATIENT_ID'].'</td>
					<td>'.$GLOBALS['current_allergy_pat_name'].'</td>
					<td>'.$GLOBALS['current_allergy_pat_age'].'</td>
					<td>'.$GLOBALS['current_allergy_pat_gender'].'</td>';

        	$sql3 = "SELECT * FROM ALLERGY WHERE ALLERGY_ID = '".$row1['ALLERGY_ID']."'";
			$result3 = mysqli_query($conn, $sql3);
			$resultCheck3 = mysqli_num_rows($result3);
			if($resultCheck3 > 0){
				if ($row3 = mysqli_fetch_assoc($result3)) {
					echo '<td>'.$row3['NAME'].'</td>';
				}	
			}
			echo '</tr>';							
		}	
	}else{
		echo '<tr><td colspan ="7" style="text-align: center;">Patient Allergy History Not Available</td></tr>';
	}
  	echo '</table>
  	</div>';
  	mysqli_close($conn);
?>