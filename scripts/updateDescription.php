<?php
	$description = $_POST["description"];
	$vocabId = $_POST["vocabId"];
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	
	$sql = $db->prepare("UPDATE vocabulary SET description=? WHERE vocabId='$vocabId'");
	$sql->bind_param("s",$description);
	$sql->execute();
	mysqli_close($db);
	header('Location: ../editApprovedVocab.php');
?>