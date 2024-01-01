<?php
	session_start();
	if(isset($_SESSION['pharm_reg_num']) == false && isset($_SESSION['pharm_password']) == false) {
		session_unset();
		session_destroy();
		header("Location: index.php?login=error");
		exit();
	}
?>
