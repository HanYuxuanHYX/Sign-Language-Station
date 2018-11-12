<?php
	$email = $_POST["email"];
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	$sql = "SELECT * FROM member WHERE email = '" . $email . "'";
	$result = mysqli_query($db,$sql) or die("SQL error!<br>");
	$row = mysqli_fetch_assoc($result);
	if($row == false)
		echo "";
	else
		echo "抱歉，该用户名已被注册";
	mysqli_close($db);
?>