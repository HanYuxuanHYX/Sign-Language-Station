<?php
require_once 'scripts/sendEmail.php';	
	
if(isset($_POST["change"])){
	$password = $_POST["password"];
	$confirm = $_POST["confirm"];
	$username = $_COOKIE["username"];
	$email = $_COOKIE["email"];
	$token = md5($username . $email . time());
	session_start();
	$_SESSION["token"] = $token;
	$_SESSION["password"] = $password;
	
	$subject = "[Sign Language Station] confirm to reset the password";
	$body = "<h1>resetPassword</h1><br>
    <h2>Please click on the button below to reset your password:</h2><br>
			<h3>http://www2.comp.polyu.edu.hk/~18012633x/SL/scripts/confirmChangePassword.php?token=" . $token . "</h3>";
	sendEmail($email,$subject,$body);
	header("Location: changePasswordSuccess.php");
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Language Station</title>
<link rel="stylesheet" type="text/css" href="css/general.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$(".dropDown").click(function(){
    	$(".dropDownContent").slideToggle("slow");
    });
	
	$("#password").blur(function(){
		if($("#password").val()==""){
			$("#password").next().text("The password should not be empty");
		}
		else{
			$("#password").next().text("");
		}
	})
	
	$("#confirm").blur(function(){
		if($("#confirm").val()!=$("#password").val()){
			$("#confirm").next().text("The password should be consistent");
		}
		else{
			$("#confirm").next().text("");
		}
	})
})

function check(){
	if($("#password").next().text()==""&&
	$("#confirm").next().text()=="")
		return true;
	return false;
}
</script>
</head>

<body>
	<?php require('header.php');?>

	<div class="mainFrame">
	  	<form id="form1" name="form1" method="post" onSubmit="return check();">
			<table>
				<tr>
					<td><label for="password">new password</label></td>
          			<td><input type="password" name="password" id="password">
                    	<span style="color: red"></span>
                    </td>
				</tr>

				<tr>
					<td><label for="confirm">confirm password</label></td>
					<td><input type="password" name="confirm" id="confirm">
                    	<span style="color: red"></span>
                    </td>
				</tr>

				<tr>
					<td colspan="2"><input type="submit" name="change" value="change"></td>
				</tr>
			</table>
	  	</form>
	</div>
	
	<?php require('footer.php');?>

</body>
</html>
