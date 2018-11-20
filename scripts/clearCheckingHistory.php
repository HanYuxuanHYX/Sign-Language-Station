<?php
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	$sql = "DELETE FROM checkinghistory WHERE email ='" . $_COOKIE["email"] . "'";
	$result = mysqli_query($db,$sql) or die("SQL error!<br>");
	header("Location: ../checkingHistory.php")
?>