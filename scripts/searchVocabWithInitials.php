<?php
	$content = $_POST["content"];
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	
	$sql = "SELECT vocabName FROM vocabulary WHERE vocabName LIKE '" . $content . "%' ORDER BY vocabName";

	$result = mysqli_query($db,$sql) or die("SQL error!<br>");
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    	echo $row['vocabName'];
		echo ',';
	}
	mysqli_close($db);
?>