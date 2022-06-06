<?php
	function redirect() {
		header('Location: login.php');
		exit();
	}

	if (!isset($_GET['email']) || !isset($_GET['token'])) {
		redirect();
	} else {
		$conn = new mysqli('198.71.225.62', 'bhupinderteach', 'Bhinda123', 'db');

		$email = $conn->real_escape_string($_GET['email']);
		$token = $conn->real_escape_string($_GET['token']);

		$sql = $conn->query("SELECT id FROM users WHERE email='$email' AND token='$token' AND isEmailConfirmed=0");

		if ($sql->num_rows > 0) {
			$conn->query("UPDATE users SET isEmailConfirmed=1, token='' WHERE email='$email'");
			echo 'Your email has been verified! You can log in now!';
			
	                     header("Location: login.php"); 
		} else
			redirect();
	}
?>

