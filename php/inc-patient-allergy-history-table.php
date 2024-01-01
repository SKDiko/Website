<?php
echo '
<div class="table-container">
	<table id="myTable">
		<tr>
			<th><button onclick="sortTable(0, true)">No&nbsp;&#8645;</button></th>
      		<th><button onclick="sortTable(1, false)">Date&nbsp;&#8645;</button></th>
      		<th><button onclick="sortTable(2, false)">Doctor&nbsp;&#8645;</button></th>
      		<th><button onclick="sortTable(3, false)">Medical&nbsp;Practice&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(4, false)">Allergy&nbsp;Name&nbsp;&#8645;</button></th>
    	</tr>';

	include 'php/data-connection.php';
	$count_rows = 1;

	$sql1 = "SELECT * FROM MED_HISTORY WHERE PATIENT_ID ='".$_SESSION['pat_id_num']."' AND NOT ALLERGY_ID ='NULL' ORDER BY MED_DATE DESC";
	$result1 = mysqli_query($conn, $sql1);
	$resultCheck1 = mysqli_num_rows($result1);
	if($resultCheck1 > 0){
		while ($row1 = mysqli_fetch_assoc($result1)) {
			echo '<tr>
					<td>'.$count_rows++.'</td>
					<td>'.$row1['MED_DATE'].'</td>';

			$sql2 = "SELECT * FROM DOCTOR WHERE REGISTRATION_NUM = '".$row1['DOCTOR_ID']."'";
			$result2 = mysqli_query($conn, $sql2);
			$resultCheck2 = mysqli_num_rows($result2);
			if($resultCheck2 > 0){
				if ($row2 = mysqli_fetch_assoc($result2)) {
					echo '<td>'.$row2['NAME'].' '.$row2['SURNAME'].'</td>';
					
					$sql7 = "SELECT * FROM MEDICAL_PRACTICE WHERE PRACTICE_NUM = '".$row2['PRACTICE_NUM']."'";
					$result7 = mysqli_query($conn, $sql7);
					$resultCheck7 = mysqli_num_rows($result7);
					if($resultCheck7 > 0){
						if ($row7 = mysqli_fetch_assoc($result7)) {
							echo '<td>'.$row7['NAME'].'</td>';
						}	
					}
				}	
			}

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
		echo '<tr><td colspan ="11" style="text-align: center;">Patient Medical History Not Available</td></tr>';
	}
  	echo '</table>
  	</div>';
  	mysqli_close($conn);
?>