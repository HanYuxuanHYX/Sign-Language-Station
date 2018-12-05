<?php
	$email = $_GET["email"];
	require_once '../connect_db.php';
	mysqli_select_db($db,$dbName);
	$sql = "DELETE FROM member WHERE email='".$email."'";
	$result = mysqli_query($db,$sql) or die("SQL error!<br>");
	mysqli_close($db);
	header('Location: ../updateUser.php');
?>