<?php
require_once 'PHPMailer/sendEmail.php';	
	
if(isset($_POST["change"])){
	$username = $_POST["username"];
	$email = $_COOKIE["email"];
	
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	$sql = "UPDATE member SET username='" . $username . "' WHERE email='" . $email . "'";			
	mysqli_query($db,$sql) or die("SQL error!<br>");
	mysqli_close($db);	
	setcookie("username", $username, time() + 3600);
	echo "<script>alert('Username has been changed successfully!');
		window.location.href='profile.php';</script>";
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
	  	<form id="form1" name="form1" method="post" onSubmit="return check();">
			<table class="defaultTable">
				<tr>
					<td><label for="username">new username</label></td>
          			<td><input type="text" name="username" id="username">
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
