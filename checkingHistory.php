<?php
	if(!isset($_COOKIE["username"])){
		header("Location: login.php");
		exit;
	}
		
	$vocabIdArray = [];
	$vocabNameArray = [];
	$checkTimeArray = [];
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	$sql = "SELECT * FROM checkinghistory WHERE email ='" . $_COOKIE["email"] . "'";
	$result = mysqli_query($db,$sql) or die("SQL error!<br>");
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		array_push($vocabIdArray,$row['vocabId']);
		array_push($vocabNameArray,$row['vocabName']);
		array_push($checkTimeArray,$row['checkTime']);
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
$(document).ready(function(){
	$(".dropDown").click(function(){
    	$(".dropDownContent").slideToggle("slow");
    });
})
</script>
</head>
<body>
	<?php require('header.php');?>
	
	<div class="mainFrame">
		<table>
		  <tbody>
          	<tr>
            	<td><b>vocabId</b></td>
                <td><b>vocabName</b></td>
                <td><b>checkTime</b></td>
            </tr>
          	<?php
				$i = 0;
				$count = count($vocabIdArray);
            	for($i=0;$i<$count;$i++)
				{
					echo "<tr><td>" . $vocabIdArray[$i] . "</td><td><a href='vocabInfo.php?content=" . $vocabNameArray[$i] . "'>" . $vocabNameArray[$i] . "</a></td><td>" . $checkTimeArray[$i] . "</td><td></tr>";
				}
			?>
          </tbody>
         </table>
         <a href="scripts/clearCheckingHistory.php">clear my searching history</a>
	</div>
	
	<?php require('footer.php');?>
</body>
</html>
