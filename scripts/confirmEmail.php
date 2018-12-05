<?php
$email = $_GET["email"];
$token = $_GET["token"];

require_once '../connect_db.php';
mysqli_select_db($db,$dbName);
$sql = $db->prepare("SELECT * FROM member WHERE token=? AND email=?");
$sql->bind_param("ss",$token,$email);
$sql->execute();
$result = $sql->get_result();
$row = mysqli_fetch_assoc($result);
if($row != false){
	$sql2 = $db->prepare("UPDATE member SET activated='1' WHERE email=?");
	$sql2->bind_param("s",$email);
	$sql2->execute();
	mysqli_close($db);
	echo "<script>alert('Your account has been activated! You can log in now.');
			window.location.href='../index.php';</script>";
}else
	echo "<script>alert('邮箱验证错误!')</script>";
?>