<?php
	$vocabId = $_GET["vocabId"];
	require_once '../connect_db.php';
	mysqli_select_db($db,$dbName);
	$sql = "DELETE FROM addingtoglossaryhistory WHERE email='" . $_COOKIE["email"] . "' AND vocabId='" . $vocabId . "'";
	$result = mysqli_query($db,$sql) or die("SQL error!<br>");
	mysqli_close($db);
	header("Location: ../glossary.php")
?>