<?php
require_once 'sendEmail.php';	

session_start();
$email = $_SESSION["email"];
$subject = "[手语小站] 邮箱确认";
$body = "<h1>欢迎来到手语小站!</h1><br>
		 <h2>请点击下方的链接来完成注册:</h2><br>
		 <h3>http://www2.comp.polyu.edu.hk/~18012633x/SL/confirmEmail.php?username=" . $_SESSION["username"] .
		 "&token=" . $_SESSION["token"] . "</h3>";
sendEmail($email,$subject,$body);
header("Location: ../registerSuccess.php");
?>