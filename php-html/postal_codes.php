<?php
	for ($x = 0; $x <= 9999; $x++) {
		if (strlen($x) == 1) {
			echo '<option value="000'.$x.'">000'.$x.'</option>';
		} elseif (strlen($x) == 2) {
			  echo '<option value="00'.$x.'">00'.$x.'</option>';
		} elseif (strlen($x) == 3) {
			echo '<option value="0'.$x.'">0'.$x.'</option>';
		} else {
			echo '<option value="'.$x.'">'.$x.'</option>';
		}
	}
?>