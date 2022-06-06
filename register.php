<?php
	$msg = "";
	use PHPMailer\PHPMailer\PHPMailer;

	if (isset($_POST['submit'])) {
		$con = new mysqli('198.71.225.62', 'bhupinderteach', 'Bhinda123', 'db');
      
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password =$_POST['password'];
		$cPassword =$_POST['cPassword'];

		if ($name == "" || $email == "" || $password != $cPassword)
			$msg = "Please check your inputs!";
		else {
			$sql = $con->query("SELECT id FROM users WHERE email='$email'");
			if ($sql->num_rows > 0) {
				$msg = "Email already exists in the database!";
			} else {
				$token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
				$token = str_shuffle($token);
				$token = substr($token, 0, 10);

				$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

				$con->query("INSERT INTO users (name,email,password,isEmailConfirmed,token)
					VALUES ('$name', '$email', '$hashedPassword', '0', '$token');
				");

                include_once "PHPMailer/src/PHPMailer.php";

                $mail = new PHPMailer();
                $mail->setFrom('bhupindersingh7551@gmail.com');
                $mail->addAddress($email, $name);
                $mail->Subject = "Please verify email!";
                $mail->isHTML(true);  
				$mail->Body = "
                   <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
<title>bhupindertech.</title>
</head>
<body style=\" font-family:'Trebuchet MS', Tahoma; margin: 0px; padding: 0px; font-size: 10pt; border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none;\">
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
	<tr>
    	<td width=\"322\" rowspan=\"18\">&nbsp;</td> 
        <td width=\"700\" align=\"center\">&nbsp;</td>
        <td width=\"386\" rowspan=\"18\">&nbsp;</td>    
	</tr>
    <tr>
    	</tr>
    <tr height=\"35\">
    	<td height=\"35\" align=\"right\" bgcolor=\"#036\" width=\"700\">
			<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"5\" cellspacing=\"5\" style=\"font-size:18px; color:#FFFFFF; font-weight:bold; height:35px;\" bgcolor=\"#036\">
			<tr>
			  <td align=\"center\">
			Thanks For Registration With Bhupinder Tech
				 
				 </td>
        	</tr></table>    
		</td>
	</tr>
    <tr>
    	<td bgcolor=\"#FFFFFF\">
        	<table width=\"100%\" border=\"2px solid #036\" align=\"center\" cellpadding=\"5\" cellspacing=\"0\" height=\"100\">
            	<tr>
                	<td valign=\"top\">    
	                    <p>Hello,</p>						
						<p>your Name: ".$name."</p>
						<p>Your Email: ".$email."</p>
						<p>Please Click here to confirm and login with Bhupinder Tech:</p>
					 
					 <a  align=\"center\" style=\"color:white; cursor: pointer; display: inline-block; font-size: 16px; border: none; border-radius: 11px; background-color:#009d00; padding:5px 12px;
					 text-decoration:none;\" href='http://bhupindertech.com/confirm.php?email=$email&token=$token&name=$name'>Click Here</a>
					
                          <p></p>
					</td>
				</tr>
		  </table>
	  </td>
	</tr>
    <tr>
    	<td>
        	<table width=\"100%\" height=\"30\" border=\"0\" cellpadding=\"5\" cellspacing=\"5\" bgcolor=\"#036\" style=\"color:#FFFFFF;\">
           	  <tr><td height=\"30\" align=\"center\"><a href=\"http://www.bhupindertech.com\" style=\"color:#FFF; text-decoration:none;\">www.bhupindertech.com</a></td></tr>
			</table>        
        </td>
    </tr>  
</table>
   
                
</body>
</html>";
                 

                if ($mail->send())
                    $msg = "You have been registered! Please verify your email!";
                else
                    $msg = "Something wrong happened! Please try again!";
			}
		}
	}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
	<div class="container" style="margin-top: 100px;">
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3" align="center">

				<img src="images/logo.png"><br><br>

				<?php if ($msg != "") echo $msg . "<br><br>" ?>

				<form method="post" action="register.php">
					<input class="form-control" name="name" placeholder="Name..."><br>
					<input class="form-control" name="email" type="email" placeholder="Email..."><br>
					<input class="form-control" name="password" type="password" placeholder="Password..."><br>
					<input class="form-control" name="cPassword" type="password" placeholder="Confirm Password..."><br>
					<input class="btn btn-primary" type="submit" name="submit" value="Register">
				</form>

			</div>
		</div>
	</div>
</body>
</html>