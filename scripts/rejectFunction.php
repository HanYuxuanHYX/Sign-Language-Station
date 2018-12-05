<?php
	$vocabId = $_GET["vocabId"];
	require_once '../connect_db.php';
	mysqli_select_db($db,$dbName);
	$sql = "DELETE FROM vocabulary WHERE vocabId ='" . $vocabId . "'";
	mysqli_query($db,$sql) or die("SQL error!<br>");
	mysqli_close($db);
	header("Location: ../approveUploadedVocab.php")
?>