<?php

if ($_SESSION['med_history_id_num'] == "") {
	echo("<script>alert('Capture Medical History Unsuccessful: Patient personal details are empty.')</script>");
 	echo("<script>window.location = 'doctor-home.php?capture-medical-history=error';</script>");
 	mysqli_close($conn);
	exit();
}

echo '
<div class="table-container">
	<table id="myTable">
		<caption><b>Disease History of '.$_SESSION['med-history-name'].' '.$_SESSION['med-history-surname'].'</b></caption>
		<tr>
			<th><button onclick="sortTable(0, true)">No&nbsp;&#8645;</button></th>
      		<th><button onclick="sortTable(1, false)">Date&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(2, false)">Disease&nbsp;Name&nbsp;&#8645;</button></th>
    	</tr>';

	include 'data-connection.php';
	$count_rows = 1;

	$sql1 = "SELECT * FROM MED_HISTORY WHERE PATIENT_ID ='".$_SESSION['med_history_id_num']."' AND NOT DISEASE_ID ='NULL' ORDER BY MED_DATE DESC";
	$result1 = mysqli_query($conn, $sql1);
	$resultCheck1 = mysqli_num_rows($result1);
	if($resultCheck1 > 0){

		while ($row1 = mysqli_fetch_assoc($result1)) {
			echo '<tr>
					<td>'.$count_rows++.'</td>
					<td>'.$row1['MED_DATE'].'</td>';

        	$sql3 = "SELECT * FROM DISEASE WHERE DISEASE_ID = '".$row1['DISEASE_ID']."'";
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
		echo '<tr><td colspan ="10" style="text-align: center;">Disease History Not Available</td></tr>';
	}
  	echo '</table>
  	</div>';
  	mysqli_close($conn);
?>