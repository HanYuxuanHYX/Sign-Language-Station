<?php
	$daysLeft = $_POST["daysLeft"];
	$email = $_POST["email"];
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	echo $daysLeft;
	$sql = $db->prepare("UPDATE member SET daysLeft=? WHERE email='$email'");
	$sql->bind_param("s",$daysLeft);
	$sql->execute();
	mysqli_close($db);
	header('Location: ../updateUser.php');
?>