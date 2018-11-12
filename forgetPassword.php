<?php
require_once 'scripts/sendEmail.php';	
	
if(isset($_POST["change"])){
	$email = $_POST["email"];
	$random = md5($email . time());
	
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	$sql = "UPDATE member SET password='" . $random . "' WHERE email='" . $email . "'";			
	mysqli_query($db,$sql) or die("SQL error!<br>");	
	mysqli_close($db);	
	
	
	$subject = "[Sign Language Station] confirm to reset your password";
	$body = "<h1>Reset Password</h1><br>
			<h2>Your new password is：</h2><br>
			<h3>" . $random . "</h3>";
	sendEmail($email,$subject,$body);
	header("Location: forgetPasswordSuccess.php");
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Language Station</title>
<link rel="stylesheet" type="text/css" href="top_bottom_list.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$(".dropDown").click(function(){
    	$(".dropDownContent").slideToggle("slow");
    });
	
	$("#email").blur(function(){
		if($("#email").val()==""){
			$("#email").next().text("Email address should not be empty!");
		}
		else{
			$("#email").next().text("");
		}
	})
})

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
			<table width="100%" border="0" cellspacing="5" cellpadding="8">
				<tr>
                    <td width="150"><label for="email">Please input your email address:</label></td>
          			<td><input type="text" name="email" id="email">
                    	<span style="color: red"></span>
                    </td>
				</tr>
                <tr>
					<td colspan="2"><input type="submit" name="change" value="submit"></td>
				</tr>
			</table>
	  	</form>
	</div>
	
	<?php require('footer.php');?>

</body>
</html>
