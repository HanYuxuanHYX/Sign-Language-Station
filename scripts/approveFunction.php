<?php
	require_once '../PHPMailer/sendEmail.php';	

	$vocabId = $_GET["vocabId"];
	$vocabName = $_GET["vocabName"];
	$submitter = $_GET["submitter"];
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	$sql = "UPDATE vocabulary SET status='approved',approver='" . $_COOKIE["email"] . "' WHERE vocabId='" . $vocabId . "'";
	mysqli_query($db,$sql) or die("SQL error!<br>");
	mysqli_close($db);
	
	$subject = "[Sign Language Station]Congratulation!";
	$body = "<h1>Congratulation!</h1><br>
    <h2>The vocabulary [" . $vocabName . "] you submitted has been approved by our admins. Thanks again for your effort!</h2><br>";
	sendEmail($submitter,$subject,$body);
	
	header("Location: ../approveUploadedVocab.php");
?>