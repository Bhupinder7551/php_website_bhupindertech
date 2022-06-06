<?php

	include './CV download/config.php';
	$msg = "";
	if (isset($_POST['submit'])) {
		//$con = new mysqli('localhost', 'research_emailC', 'test123', 'research_phpEmailConfirmation');

		$email = $conn->real_escape_string($_POST['email']);
		$password = $conn->real_escape_string($_POST['password']);

		if ($email == "" || $password == "")
			$msg = "Please check your inputs!";
		else {
			$sql = $conn->query("SELECT id, password, isEmailConfirmed FROM users WHERE email='$email'");
			if ($sql->num_rows > 0) {
                $data = $sql->fetch_array();
                if (password_verify($password, $data['password'])) {
                    if ($data['isEmailConfirmed'] == 0)
	                    $msg = "Please verify your email!";
                    else {
	                     header("Location: index.php"); 
                    }
                } else
	                $msg = "Please check your inputs!";
			} else {
				$msg = "Please check your inputs!";
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style_registration.css">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" action="login.php" id="signup-form" class="signup-form">
                        <h2 class="form-title">Login</h2>
											  <?php if ($msg != "") echo $msg . "<br><br>" ?>
                     
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                 
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="login"/>
                        </div>
                    </form>
                 
                </div>
            </div>
        </section>

    </div>


</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>