<?php
	$description = $_POST["description"];
	$vocabId = $_POST["vocabId"];
	require_once '../connect_db.php';
	mysqli_select_db($db,$dbName);
	
	$sql = $db->prepare("UPDATE vocabulary SET description=? WHERE vocabId='$vocabId'");
	$sql->bind_param("s",$description);
	$sql->execute();
	mysqli_close($db);
	header('Location: ../editApprovedVocab.php');
?>