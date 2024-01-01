<?php
	include 'php/data-connection.php';

	$sql1 = "SELECT * FROM MED_HISTORY WHERE PATIENT_ID ='".$_SESSION['dispense_pat_id_num']."' AND NOT ALLERGY_ID ='NULL' ORDER BY MED_DATE DESC";
	$result1 = mysqli_query($conn, $sql1);
	$resultCheck1 = mysqli_num_rows($result1);
	if($resultCheck1 > 0){
        echo "<ul>";
		while ($row1 = mysqli_fetch_assoc($result1)) {

        	$sql3 = "SELECT * FROM ALLERGY WHERE ALLERGY_ID = '".$row1['ALLERGY_ID']."'";
			$result3 = mysqli_query($conn, $sql3);
			$resultCheck3 = mysqli_num_rows($result3);
			if($resultCheck3 > 0){
				if ($row3 = mysqli_fetch_assoc($result3)) {
					echo '<li><p>'.$row1['MED_DATE'].' | '.$row3['NAME'].'</li></p>';
				}	
			}							
		}
		echo "</ul>";	
	}else{
		echo '<p>No Allergy History Available</p>';
	}
  	mysqli_close($conn);
?>