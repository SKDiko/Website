<?php
if (isset($_GET['med_name']) == false || $_GET['med_name'] =="") {
	echo("<script>alert('Search Medication Unsuccessful: Please Select medication name.')</script>");
	echo("<script>window.location = 'doctor-load-prescriptions.php?medication-search=error';</script>");
}

echo '
<div class="table-container">
	<table id="myTable">
		<tr>
			<th><button onclick="sortTable(0, true)">No&nbsp;&#8645;</button></th>
      		<th><button onclick="sortTable(1, false)">Medication&nbsp;Name&nbsp;&#8645;</button></th>
      		<th><button onclick="sortTable(2, false)">Dosage Form&nbsp;&#8645;</button></th>
      		<th><button onclick="sortTable(3, false)">Schedule&nbsp;&#8645;</button></th>
	      	<th><button onclick="sortTable(4, true)">Active&nbsp;Ingredients&nbsp;&#8645;</button></th>
	      	<th><button>Select&nbsp;Medication</button></th>
    	</tr>';

	include 'data-connection.php';
	$count_rows = 1;

	$sql1 = "SELECT * FROM MEDICATION WHERE NAME ='".$_GET['med_name']."'";
	$result1 = mysqli_query($conn, $sql1);
	$resultCheck1 = mysqli_num_rows($result1);
	if($resultCheck1 > 0){

		while ($row1 = mysqli_fetch_assoc($result1)) {
			$GLOBALS['wdn_med_id'] = $row1['MED_ID'];
			$GLOBALS['wdn_med_name'] = $row1['NAME'];
			echo 
			'<tr>
				<td>'.$count_rows++.'</td>
				<td>'.$GLOBALS['wdn_med_name'].'</td>
				<td>'.$row1['DOSAGE_FORM'].'</td>
				<td>S'.$row1['SCHEDULE'].'</td>';

			$ingredient = "";
			$sql2 = "SELECT * FROM ACTIVE_INGREDIENT WHERE MED_ID = '".$row1['MED_ID']."'";
			$result2 = mysqli_query($conn, $sql2);
			$resultCheck2 = mysqli_num_rows($result2);
			if($resultCheck2 > 0){
				while ($row2 = mysqli_fetch_assoc($result2)) {
					$ingredient .= $row2['NAME'].': '.$row2['STRENGTH'].'<br>';
				}
			}
			echo '<td>'.$ingredient.'</td>';
			echo '<td><button type="submit" name="btnSelect" id="btnSelect" formaction="php/data-doctor-medication-popup-list-get-medication.php?med_id='.$GLOBALS['wdn_med_id'].'&med_name='.$GLOBALS['wdn_med_name'].'">Select</button></td>';
			echo '</tr>';					
		}	
	}else{
		echo '<tr><td colspan ="10" style="text-align: center;">No Medication Available</td></tr>';
	}
  	echo '</table>
  	</div>';
  	mysqli_close($conn);
?>