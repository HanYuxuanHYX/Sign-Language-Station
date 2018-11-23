<?php
	$daysLeft = $_POST["daysLeft"];
	$email = $_POST["email"];
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	echo $daysLeft;
	$sql = "UPDATE member SET daysLeft='$daysLeft' WHERE email='$email' ";
	$result = mysqli_query($db,$sql) or die("SQL error!<br>");
	//mysqli_close($con);
	header('Location: ../updateUser.php');
?>