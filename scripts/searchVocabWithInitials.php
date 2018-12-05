<?php
	$content = $_POST["content"];
	require_once '../connect_db.php';
	mysqli_select_db($db,$dbName);
	
	$sql = "SELECT vocabName FROM vocabulary WHERE vocabName LIKE '" . $content . "%' ORDER BY vocabName";

	$result = mysqli_query($db,$sql) or die("SQL error!<br>");
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    	echo $row['vocabName'];
		echo ',';
	}
	mysqli_close($db);
?>