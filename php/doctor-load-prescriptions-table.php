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
	    <caption><b>Prescription Details of '.$_SESSION['med-history-name'].' '.$_SESSION['med-history-surname'].'</b></caption>
		<tr>
			<th><button onclick="sortTable(0, true)">No&nbsp;&#8645;</button></th>
      		<th><button onclick="sortTable(1, false)">Date&nbsp;&#8645;</button></th>
      		<th><button onclick="sortTable(2, false)">Medication Name&nbsp;&#8645;</button></th>
      		<th><button onclick="sortTable(3, true)">Quantity&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(4, true)">Repeats&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(5, false)">Instructions&nbsp;&#8645;</button></th>
    	</tr>';

	include 'data-connection.php';
	$count_rows = 1;

	$sql1 = "SELECT * FROM PRESCRIPTION WHERE PATIENT_ID ='".$_SESSION['med_history_id_num']."' AND STATUS ='Unconfirmed' ORDER BY PRESCRIPTION_DATE DESC";
	$result1 = mysqli_query($conn, $sql1);
	$resultCheck1 = mysqli_num_rows($result1);
	if($resultCheck1 > 0){
		while ($row1 = mysqli_fetch_assoc($result1)) {

			echo '<tr>
					<td>'.$count_rows++.'</td>
					<td>'.$row1['PRESCRIPTION_DATE'].'</td>';


			$sql4 = "SELECT * FROM MEDICATION WHERE MED_ID = '".$row1['MED_ID']."'";
			$result4 = mysqli_query($conn, $sql4);
			$resultCheck4 = mysqli_num_rows($result4);
			if($resultCheck4 > 0){
				if ($row4 = mysqli_fetch_assoc($result4)) {
					echo '<td>'.$row4['NAME'].'</td>';
				}	
			}

			echo 
			'<td>'.$row1['QUANTITY'].'</td>
			<td>'.$row1['ORIGINAL_REPEATS'].'</td>
			<td>'.$row1['INSTRUCTIONS'].'</td>';

			echo '</tr>';							
		}	
	}else{
		echo '<tr><td colspan ="10" style="text-align: center;">Prescription Details Not Available</td></tr>';
	}
  	echo '</table>
  	</div>';
  	mysqli_close($conn);
?>