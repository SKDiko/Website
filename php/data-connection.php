<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "Masora11";
$dbname = "prescribing_system";

//Connext to database
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbname);

//Test database connection
if(!$conn) { 
	echo'<script>window.alert("Database Connection Failed!");</script>'; 
	die("Database Connection Failed: " . mysqli_connect_error());
	mysqli_close($conn);
	exit();
}