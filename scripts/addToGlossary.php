<?php
	$vocabId = $_POST["vocabId"];
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	$sql = "UPDATE vocabulary SET addTotal=addTotal+1 WHERE vocabId='" . $vocabId . "'";
	mysqli_query($db,$sql) or die("SQL error!<br>");
	$sql2 = "INSERT INTO addingtoglossaryhistory(email,vocabId,addTime) VALUES('" . $_COOKIE['email'] . "','" . $vocabId . "','" . date('Y-m-d') . "')";
	mysqli_query($db,$sql2) or die("SQL error!<br>");
	mysqli_close($db);
?>