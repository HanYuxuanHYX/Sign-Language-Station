<?php
	$vocabId = $_POST["vocabId"];
	$vocabName = $_POST["vocabName"];
	require_once '../connect_db.php';
	mysqli_select_db($db,$dbName);
	$sql = "UPDATE vocabulary SET addTotal=addTotal+1 WHERE vocabId='" . $vocabId . "'";
	mysqli_query($db,$sql) or die("SQL error!<br>");
	$sql2 = "INSERT INTO addingtoglossaryhistory(email,vocabId,vocabName,addTime) VALUES('" . $_COOKIE['email'] . "','" . $vocabId . "','" . $vocabName . "','" . date('Y-m-d') . "')";
	echo $sql2;
	mysqli_query($db,$sql2) or die("SQL error!<br>");
	mysqli_close($db);
?>