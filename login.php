<?php
if(isset($_COOKIE["username"]))
	header("Location: profile.php");
else{
	if(isset($_POST["login"])){
		$username = $_POST["username"];
		$password = $_POST["password"];
		if(empty($username)){
			echo "<script>alert('User name is empty!')</script>";
		}
		else if(empty($password)){
			echo "<script>alert('Email address is empty!')</script>";
		}
		else{
			$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
			mysqli_select_db($db,"18012633x");
			$sql = "SELECT * FROM member WHERE password='" . 
				$password . "' AND ( username = '" . 
				$username . "' OR email = '" . $username . "')" .
				"AND activated = '1'";
			$result = mysqli_query($db,$sql) or die("SQL error!<br>");
			$row = mysqli_fetch_assoc($result);
			if($row != false){
				setcookie("username", $username, time() + 3600);
				setcookie("email", $row["email"], time() + 3600);
				setcookie("registerDate", $row["registerDate"], time() + 3600);
				setcookie("daysLeft", $row["daysLeft"], time() + 3600);
				mysqli_close($db);
				header("Location: index.php");
			}			
			else
				echo "<script>alert('Username/email address or password is incorrect')</script>";

		}
	}
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
})
</script>
</head>

<body>
	<?php require('header.php');?>

	<div class="mainFrame">
		Please Log In:
	  	<form id="form1" name="form1" method="post">
			<table width="100%" border="0" cellspacing="5" cellpadding="8">
				<tr>
					<td width="100"><label for="username">username/email address</label></td>
          			<td width="200"><input type="text" name="username" id="username"></td>
				</tr>

				<tr>
					<td><label for="password">password</label></td>
					<td><input type="password" name="password" id="password"></td>
                    <td><a href="forgetPassword.php">forgetPassword？</a></td>
				</tr>

				<tr>
					<td><input type="submit" name="login" value="login"></td>
					<td><a href="register.php">Haven't got an account? Click here to sign up.</a></td>
				</tr>
			</table>
	  	</form>
	</div>
	
	<?php require('footer.php');?>
</body>
</html>
