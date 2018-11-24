<?php
	$description = $_POST["description"];
	$vocabId = $_POST["vocabId"];
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	$sql = "UPDATE vocabulary SET description='$description' WHERE vocabId='$vocabId' ";
	$result = mysqli_query($db,$sql) or die("SQL error!<br>");
	mysqli_close($db);
	header('Location: ../editApprovedVocab.php');
?>