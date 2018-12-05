<?php
	$videoSource = $_POST["videoSource"];
	$vocabId = $_POST["vocabId"];
	require_once '../connect_db.php';
	mysqli_select_db($db,$dbName);
	$sql = $db->prepare("UPDATE vocabulary SET videoSource=? WHERE vocabId='$vocabId'");
	$sql->bind_param("s",$videoSource);
	$sql->execute();
	mysqli_close($db);
	header('Location: ../editApprovedVocab.php');
?>