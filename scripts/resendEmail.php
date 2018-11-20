<?php
require_once '../PHPMailer/sendEmail.php';	

session_start();
$email = $_SESSION["email"];
$subject = "[Sign Language Station] Confirm your email address";
$body = "<h1>Welcome to Sign Language Station</h1><br>
		<h2>Please click the link below to finish signing up</h2><br>
		 <h3>http://www2.comp.polyu.edu.hk/~18012633x/SL_EN/scripts/confirmEmail.php?username=" . $_SESSION["username"] .
		 "&token=" . $_SESSION["token"] . "</h3>";
sendEmail($email,$subject,$body);
header("Location: ../registerSuccess.php");
?>