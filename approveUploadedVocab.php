<?php
	if(!isset($_COOKIE["email"])){
		header("Location: login.php");
		exit;
	}
	
	$vocabIdArray = [];
	$vocabNameArray = [];
	$submitterArray = [];
	$descriptionArray = [];
	$videoSourceArray = [];
	
	
	require_once 'connect_db.php';
	mysqli_select_db($db,$dbName);
	
	$sql1 = $db->prepare("SELECT * FROM permission WHERE title=?");
	$sql1->bind_param('s',$_COOKIE["title"]);
	$sql1->execute();
	$result1 = $sql1->get_result();
	$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
	
	if($row1["editUnapprovedVocab"]==1){
		$sql = "SELECT * FROM vocabulary WHERE status='unapproved'";
		$result = mysqli_query($db,$sql) or die("SQL error!<br>");
		mysqli_close($db);
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			array_push($vocabIdArray,$row['vocabId']);
			array_push($vocabNameArray,$row['vocabName']);
			array_push($submitterArray,$row['submitter']);
			array_push($descriptionArray,$row['description']);
			array_push($videoSourceArray,$row['videoSource']);		
		}
	}else{
		mysqli_close($db);
		echo "<script>alert('You do not have the authority to do this!');
			window.location.href='adminFunctions.php';</script>";
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
<style>
table{
	width: auto;
	border: 0px;
	margin: 20px;
}

td{
	height:60px;
	font-size:16px;
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
            	<td width=5%><b>vocabId</b></td>
                <td width=10%><b>vocabName</b></td>
                <td width= 15%><b>submitter</b></td>
                <td width=30%><b>description</b></td>
                <td width=15%><b>video</b></td>
                <td width=8%><b>approve</b></td>
                <td width=5%><b>reject</b></td>
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
					<td><a href='scripts/approveFunction.php?vocabId=" . $vocabIdArray[$i] . "&vocabName=" . $vocabNameArray[$i] . "&submitter=" . $submitterArray[$i] . "'>approve</a></td>
					<td><a href='scripts/rejectFunction.php?vocabId=" . $vocabIdArray[$i] . "'>reject</a></td></tr>";
				}
			?>
          </tbody>
         </table>
	</div>
	
	<?php require('footer.php');?>

</body>
</html>
