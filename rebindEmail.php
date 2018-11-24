<?php
require_once 'PHPMailer/sendEmail.php';	
	
if(isset($_POST["change"])){
	$newEmail = $_POST["email"];
	$username = $_COOKIE["username"];
	$token = md5($username . $newEmail . time());
	session_start();
	$_SESSION["token"] = $token;
	$_SESSION["newEmail"] = $newEmail;
	
	$subject = "[Sign Language Station] confirm to rebind the email";
	$body = "<h1>Rebind Email</h1><br>
    <h2>Please click on the button below to rebind your email:</h2><br>
			<h3>http://www2.comp.polyu.edu.hk/~18012633x/SL_EN/scripts/confirmRebindEmail.php?token=" . $token . "</h3>";
	sendEmail($newEmail,$subject,$body);
	header("Location: rebindEmailSuccess.php");
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
	$("#email").blur(function(){
    	if($("#email").val()==""){
			$("#email").next().text("The email cannot be empty!");
		}
		else{
		$.post("scripts/checkRepeat.php",
    	   	{email:$("#email").val()},
    	   	function(data,status){
    	   		$("#email").next().text(data);
    		});
		}
	})
})
	
function DropDown(){
	$(".dropDownContent").slideToggle("fast");
};

function check(){
	if($("#email").next().text()=="")
		return true;
	return false;
}
</script>
</head>

<body>
	<?php require('header.php');?>

	<div class="mainFrame">
	  	<form id="form1" name="form1" method="post" onSubmit="return check();">
			<table class="defaultTable">
				<tr>
					<td><label for="email">new email</label></td>
          			<td><input type="text" name="email" id="email"><span style="color: red"></span></td>
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
