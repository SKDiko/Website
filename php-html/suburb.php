<?php
$suburb = array();

$suburb = array_unique($suburb);
sort($suburb);

foreach($suburb as $x => $x_value) {
	echo '<option value="'.trim($suburb[$x]).'">'.trim($suburb[$x]).'</option>';
}
?>
