<?php
$email = $_GET["email"];
$token = $_GET["token"];

$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
mysqli_select_db($db,"18012633x");
$sql = "SELECT * FROM member WHERE token='" . 
		$token . "' AND email = '" . 
		$email . "'";
$result = mysqli_query($db,$sql) or die("SQL error!<br>");
$row = mysqli_fetch_assoc($result);
if($row != false){
	$sql2 = "UPDATE member SET activated='1' WHERE email='" . $email . "'";
	mysqli_query($db,$sql2) or die("SQL error!<br>");
	mysqli_close($db);
	echo "<script>alert('Your account has been activated! You can log in now.');
			window.location.href='../index.php';</script>";
}else
	echo "<script>alert('邮箱验证错误!')</script>";
?>