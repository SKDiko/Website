<?php
	session_start();
	if(isset($_SESSION['pat_id_num']) == false && isset($_SESSION['pat_password']) == false) {
		session_unset();
		session_destroy();
		header("Location: index.php?login=error");
		exit();
	}
?>
