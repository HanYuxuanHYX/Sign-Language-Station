<?php
if(isset($_COOKIE["email"]))
	header("Location: profile.php");
else{
	if(isset($_POST["login"])){
		$email = $_POST["email"];
		$password = $_POST["password"];
		if(empty($email)){
			echo "<script>alert('Email is empty!')</script>";
		}
		else if(empty($password)){
			echo "<script>alert('password is empty!')</script>";
		}
		else{
			$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
			mysqli_select_db($db,"18012633x");
			$sql = "SELECT * FROM member WHERE password='" . 
				$password . "' AND  email = '" . $email."'" 
				."AND activated = '1'";
			$result = mysqli_query($db,$sql) or die("SQL error!<br>");
			$row = mysqli_fetch_assoc($result);
			if($row != false){
				
				setcookie("email", $email, time() + 3600);
				setcookie("username", $row["username"], time() + 3600);
				setcookie("registerDate", $row["registerDate"], time() + 3600);
				setcookie("title",$row["title"], time() + 3600);
				setcookie("daysLeft", $row["daysLeft"], time() + 3600);
				mysqli_close($db);
				header("Location: index.php");
			}			
			else
				echo "<script>alert('email address or password is incorrect')</script>";

		}
	}
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
function DropDown(){
	$(".dropDownContent").slideToggle("fast");
};
</script>
</head>

<body>
	<?php require('header.php');?>

	<div class="mainFrame">
	  	<form id="form1" name="form1" method="post">
			<table class="defaultTable">
            	<tr>
                	<td colspan="2"><span style="color:red">Please Log In:</span><td>
                </tr>
				<tr>
					<td><label for="email">email address</label></td>
          			<td><input type="text" name="email" id="email"></td>
				</tr>

				<tr>
					<td><label for="password">password</label></td>
					<td><input type="password" name="password" id="password"></td>
                    <td><a href="forgetPassword.php">forget password？</a></td>
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
