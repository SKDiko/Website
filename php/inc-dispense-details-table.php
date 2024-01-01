<?php

if (isset($_GET['pre_id']) == false || $_GET['pre_id'] =="") {
	echo("<script>alert('View Prescription Unsuccessful: Please select prescription.')</script>");
	echo("<script>window.location = 'pharmacist-view-prescriptions.php?view-prescription=error';</script>");
}

echo '
<div class="table-container">
	<table id="myTable">
		<tr>
			<th><button onclick="sortTable(0, true)">No&nbsp;&#8645;</button></th>
      		<th><button onclick="sortTable(1, false)">Dispense&nbsp;Date&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(2, false)">Pharmacist&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(3, false)">Pharmacy&nbsp;&#8645;</button></th>
    	</tr>';

	include 'data-connection.php';
	$count_rows = 1;

	$sql1 = "SELECT * FROM DISPENSE_PRESCRIPTION WHERE PRESCRIPTION_ID = '".$_GET['pre_id']."' ORDER BY DISPENSE_DATE ASC";
	$result1 = mysqli_query($conn, $sql1);
	$resultCheck1 = mysqli_num_rows($result1);
	if($resultCheck1 > 0){

		while ($row1 = mysqli_fetch_assoc($result1)) {
			echo 
			'<tr>
				<td>'.$count_rows++.'</td>
				<td>'.$row1['DISPENSE_DATE'].'</td>';

			$sql2 = "SELECT * FROM PHARMACIST WHERE REGISTRATION_NUM = '".$row1['PHARMACIST_ID']."'";
			$result2 = mysqli_query($conn, $sql2);
			$resultCheck2 = mysqli_num_rows($result2);
			if($resultCheck2 > 0){
				if ($row2 = mysqli_fetch_assoc($result2)) {
					echo '<td>'.$row2['NAME'].' '.$row2['SURNAME'].'</td>';

					$sql9 = "SELECT * FROM PHARMACY WHERE LICENSE_NUM = '".$row2['PHARMACY_ID']."'";
					$result9 = mysqli_query($conn, $sql9);
					$resultCheck9 = mysqli_num_rows($result9);
					if($resultCheck9 > 0){
						if ($row9 = mysqli_fetch_assoc($result9)) {
							echo '<td>'.$row9['NAME'].'</td>';
						}	
					}
				}
			}
			echo '</tr>';					
		}	
	}else{
		echo '<tr><td colspan ="10" style="text-align: center;">No Dispense Details Available</td></tr>';
	}
  	echo '</table>
  	</div>';
  	mysqli_close($conn);
?>