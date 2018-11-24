<?php
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	$sql = "UPDATE member SET daysLeft=daysLeft-1 WHERE daysLeft>0";
	mysqli_query($db,$sql) or die("SQL error!<br>");
	$sql2 = "UPDATE member SET title='expiredUser' WHERE daysLeft=0";
	mysqli_query($db,$sql2) or die("SQL error!<br>");
	mysqli_close($db);
?>