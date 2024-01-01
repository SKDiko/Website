<?php
	session_start();
	if(isset($_SESSION['doc_reg_num']) == false && isset($_SESSION['doc_password']) == false) {
		session_unset();
		session_destroy();
		header("Location: index.php?login=error");
		exit();
	}
?>
