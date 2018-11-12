<?php
require_once 'scripts/sendEmail.php';	

if(isset($_POST["register"])){
	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$birthday = $_POST["birthday"];
	$disability = $_POST["disability"];
		
		$registerDate = date('Y-m-d');
		$token = md5($username . $email . $password . $registerDate);
		$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
		mysqli_select_db($db,"18012633x");
		$sql = "INSERT INTO member(email,username,password,birthday,disability,title,registerDate,token,activated,icon,daysLeft)" . 
			   "VALUES('" . $email . "','" . $username . "','" . $password . "','" . $birthday . "','" . $disability . "','" .
			   "visitor" . "','" . $registerDate . "','" . $token . "','" . 0 .  "','" . "Iconpath" . "','" . 30 . "')";
		mysqli_query($db,$sql) or die("SQL error!<br>");
		mysqli_close($db);
		
		$subject = "[Sign Language Station] Confirm your email address";
		$body = "<h1>Welcome to Sign Language Station</h1><br>
				<h2>Please click the link below to finish signing up</h2><br>
				<h3>http://www2.comp.polyu.edu.hk/~18012633x/SL/scripts/confirmEmail.php?username=" . $username .
				"&token=" . $token . "</h3>";
		sendEmail($email,$subject,$body);
		
		session_start();
		$_SESSION["username"] = $username;
		$_SESSION["email"] = $email;
		$_SESSION["token"] = $token;
		
		header("Location: registerSuccess.php");
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
    
	$("#username").blur(function(){
		if($("#username").val()==""){
			$("#username").next().text("The username cannot be empty!");
		}
		else{
			$("#username").next().text("");
		}
	})
	
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
    });
    
    $("#password").blur(function(){
		if($("#password").val()==""){
			$("#password").next().text("The password cannot be empty!");
		}
		else{
			$("#password").next().text("");
		}
	})
	
	$("#confirm").blur(function(){
		if($("#confirm").val()!=$("#password").val()){
			$("#confirm").next().text("The password should be consistent!");
		}
		else{
			$("#confirm").next().text("");
		}
	})
	
	$("#birthday").blur(function(){
		if($("#birthday").val()==""){
			$("#birthday").next().text("The birthday should not be empty!");
		}
		else{
			$("#birthday").next().text("");
		}
	})
	
	$("#disability").blur(function(){
		if($("#disability").val()==""){
			$("#disability").next().text("Disability should not be empty!");
		}
		else{
			$("#disability").next().text("");
		}
	})
});

function check(){
	if($("#username").next().text()=="" &&
	$("#email").next().text()=="" && 
	$("#password").next().text()=="" &&
	$("#confirm").next().text()=="" &&
	$("#birthday").next().text()=="" &&
	$("#disability").next().text()=="")
		return true;
	return false;
}
</script>
</head>

<body>
	<?php require('header.php');?>

	<div class="mainFrame">
		<span style="color: red">You must fill in every column！</span>
	  	<form id="form1" name="form1" method="post" onSubmit="return check();">
			<table width="100%" border="0" cellspacing="5" cellpadding="8">
				<tr>
					<td width="100"><label for="username">username:</label></td>
          			<td><input type="text" name="username" id="username">
          				<span style="color: red"></span>
          			</td>
				</tr>

				<tr>
					<td width="100"><label for="email">email:</label></td>
					<td><input type="email" name="email" id="email">
						<span style="color: red"></span>
					</td>

				</tr>

				<tr>
					<td width="100"><label for="password">password:</label></td>
					<td><input type="password" name="password" id="password">
						<span style="color: red"></span>
					</td>
					
				</tr>

				<tr>
					<td width="100"><label for="confirm">confimPassword:</label></td>
					<td><input type="password" name="confirm" id="confirm">
						<span style="color: red"></span>
					</td>
					
				</tr>
				
				<tr>
					<td width="100"><label for="birthday">birthday:</label></td>
					<td><input type="date" name="birthday" id="birthday">
						<span style="color: red"></span>
					</td>
					
				</tr>

				
				<tr>
					<td width="100"><label for="disability">disability:</label></td>
					<td><select name="disability" id="disability">
						<option value="hearingDisability">hearhearingDisability</option>
						<option value="speakingDisability">spspeakingDisability</option>
						<option value="both">both</option>
						<option value="neither">neineither</option>
						</select>
						<span style="color: red"></span>
					</td>					
				</tr>
				
				<tr>
					<td id="isOK" colspan="2"></td>
				</tr>
				
				<tr>
					<td colspan="2"><input type="submit" name="register" value="signup"></td>
				</tr>
			</table>
	  	</form>
	</div>
	
	<?php require('footer.php');?>

</body>
</html>
