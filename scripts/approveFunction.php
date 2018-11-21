<?php
	$vocabId = $_GET["vocabId"];
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	$sql = "UPDATE vocabulary SET status='approved',approver='" . $_COOKIE["email"] . "' WHERE vocabId='" . $vocabId . "'";
	mysqli_query($db,$sql) or die("SQL error!<br>");
	mysqli_close($db);
	header("Location: ../approveUploadedVocab.php")
?>