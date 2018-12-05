<?php
	require_once '../connect_db.php';
	mysqli_select_db($db,$dbName);
	$sql = "UPDATE member SET daysLeft=daysLeft-1 WHERE daysLeft>0 AND (title='visitor' OR title='subscribedUser')";
	mysqli_query($db,$sql) or die("SQL error!<br>");
	$sql2 = "UPDATE member SET title='expiredUser' WHERE daysLeft=0";
	mysqli_query($db,$sql2) or die("SQL error!<br>");
	mysqli_close($db);
?>