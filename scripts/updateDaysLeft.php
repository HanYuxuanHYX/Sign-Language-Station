<?php
	$daysLeft = $_POST["daysLeft"];
	$email = $_POST["email"];
	require_once '../connect_db.php';
	mysqli_select_db($db,$dbName);
	echo $daysLeft;
	$sql = $db->prepare("UPDATE member SET daysLeft=? WHERE email='$email'");
	$sql->bind_param("s",$daysLeft);
	$sql->execute();
	mysqli_close($db);
	header('Location: ../updateUser.php');
?>