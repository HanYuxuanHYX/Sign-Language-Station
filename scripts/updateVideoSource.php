<?php
	$videoSource = $_POST["videoSource"];
	$vocabId = $_POST["vocabId"];
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	$sql = $db->prepare("UPDATE vocabulary SET videoSource=? WHERE vocabId='$vocabId'");
	$sql->bind_param("s",$videoSource);
	$sql->execute();
	mysqli_close($db);
	header('Location: ../editApprovedVocab.php');
?>