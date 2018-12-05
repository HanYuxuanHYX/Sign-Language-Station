<?php
	$email = $_POST["email"];
	require_once '../connect_db.php';
	mysqli_select_db($db,$dbName);
	$sql = $db->prepare("SELECT * FROM member WHERE email=?");
	$sql->bind_param("s",$email);
	$sql->execute();
	$result = $sql->get_result();
	$row = mysqli_fetch_assoc($result);
	if($row == false)
		echo "";
	else
		echo "Sorry, this email has already been registered";
	mysqli_close($db);
?>