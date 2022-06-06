<?php
	$host = "198.71.225.62";
	$user = "bhupinderteach";
	$pass = "Bhinda123";
	$db = "db";
	
	$conn = new mysqli($host, $user, $pass, $db);
	if($conn->connect_error){
		echo "Failed:" . $conn->connect_error;
	}
?>
