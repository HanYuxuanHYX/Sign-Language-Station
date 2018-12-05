<?php
	require_once '../connect_db.php';
	mysqli_select_db($db,$dbName);
	$sql = "DELETE FROM checkinghistory WHERE email ='" . $_COOKIE["email"] . "'";
	$result = mysqli_query($db,$sql) or die("SQL error!<br>");
	header("Location: ../checkingHistory.php")
?>