<?php
	if(!isset($_COOKIE["username"])){
		header("Location: login.php");
		exit;
	}
	
	$vocabIdArray = [];
	$vocabNameArray = [];
	$submitterArray = [];
	$descriptionArray = [];
	$videoSourceArray = [];
	
	
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	
	$sql1 = "SELECT editUnapprovedVocab FROM permission,member 
			WHERE member.title=permission.title AND
			email='" . $_COOKIE["email"] . "'";
	$result1 = mysqli_query($db,$sql1) or die("SQL error!<br>");
	$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
	if($row1["editUnapprovedVocab"]==1){
		$sql = "SELECT * FROM vocabulary WHERE status='unapproved'";
		$result = mysqli_query($db,$sql) or die("SQL error!<br>");
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			array_push($vocabIdArray,$row['vocabId']);
			array_push($vocabNameArray,$row['vocabName']);
			array_push($submitterArray,$row['submitter']);
			array_push($descriptionArray,$row['description']);
			array_push($videoSourceArray,$row['videoSource']);		
		}
	}else{
		echo "<script>alert('You do not have the authority to do this!');
			window.location.href='adminFunctions.php';</script>";
	}
	mysqli_close($db);
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
<style>
table{
	width: 1600px;
	border: 0px;
	margin: 50px;
}

td{
	height:80px;
	font-size:14px;
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;	
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>

<body>
	<?php require('header.php');?>

	<div class="mainFrame">
		<table>
		  <tbody>
          	<tr>
            	<td width="100px"><b>vocabId</b></td>
                <td width="150px"><b>vocabName</b></td>
                <td width="300px"><b>submitter</b></td>
                <td width="500px"><b>description</b></td>
                <td width="250px"><b>video</b></td>
                <td width="100px"><b>approve</b></td>
                <td width="100px"><b>reject</b></td>
            </tr>
          	<?php
				$i = 0;
				$count = count($vocabIdArray);
            	for($i=0;$i<$count;$i++)
				{
					echo "<tr><td>" . $vocabIdArray[$i] . "</td>
					<td>" . $vocabNameArray[$i] . "</td>
					<td>" . $submitterArray[$i] . "</td>
					<td>" . $descriptionArray[$i] . "</td>
					<td><a href='videoOnly.php?videoSource=" . $videoSourceArray[$i]. "'>click here to view the video</a></td>
					<td><a href='scripts/approveFunction.php?vocabId=" . $vocabIdArray[$i] . "'>approve</a></td>
					<td><a href='scripts/rejectFunction.php?vocabId=" . $vocabIdArray[$i] . "'>reject</a></td></tr>";
				}
			?>
          </tbody>
         </table>
	</div>
	
	<?php require('footer.php');?>

</body>
</html>
