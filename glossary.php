<?php
	if(!isset($_COOKIE["email"]))
		header("Location: login.php");
		
	$vocabIdArray = [];
	$vocabNameArray = [];
	$addTimeArray = [];
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	$sql = "SELECT * FROM addingtoglossaryhistory WHERE email ='" . $_COOKIE["email"] . "'";
	$result = mysqli_query($db,$sql) or die("SQL error!<br>");
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		array_push($vocabIdArray,$row['vocabId']);
		array_push($vocabNameArray,$row['vocabName']);
		array_push($addTimeArray,$row['addTime']);
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Language Station</title>
<link rel="stylesheet" type="text/css" href="css/general.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function DropDown(){
	$(".dropDownContent").slideToggle("fast");
};
</script>
</head>
<body>
	<?php require('header.php');?>
	
	<div class="mainFrame">
		<table class="defaultTable">
		  <tbody>
          	<tr>
            	<td><b>Vocabulary Id</b></td>
                <td><b>Vocabulary Name</b></td>
                <td><b>Added Time</b></td>
                <td><b>Drop Vocabularies</b></td>
            </tr>
          	<?php
				$i = 0;
				$count = count($vocabIdArray);
            	for($i=0;$i<$count;$i++)
				{
					echo "<tr><td>" . $vocabIdArray[$i] . "</td>
					<td><a href='vocabInfo.php?content=" . $vocabNameArray[$i] . "'>" . $vocabNameArray[$i] . "</a></td>
					<td>" . $addTimeArray[$i] . "</td>
					<td><a href='scripts/dropVocab.php?vocabId=" . $vocabIdArray[$i] . "'>drop</a></td></tr>";
				}
			?>
          </tbody>
         </table>
	</div>
	
	<?php require('footer.php');?>
</body>
</html>
