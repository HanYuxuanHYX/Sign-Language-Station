<?php
$token = $_GET["token"];
$email = $_COOKIE["email"];

session_start();
$password = $_SESSION["password"];

if($token == $_SESSION["token"]){
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	$sql = $db->prepare("UPDATE member SET password=? WHERE email=?");
	$sql->bind_param("ss",$password,$email);
	$sql->execute();
	
	mysqli_close($db);	
	session_destroy();
	echo "<script>alert('Password has been successfully updated!');
			window.location.href='../profile.php';</script>";
}else{
	echo "<script>alert('授权失败!')</script>";
	session_destroy();
}
?>