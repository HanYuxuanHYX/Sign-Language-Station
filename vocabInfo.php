<?php
	if(!isset($_COOKIE["username"])){
		header("Location: login.php");
		exit;
	}
	
	$content = $_GET["content"];
	if($content == ""){
		header("Location: index.php");
		exit;
	}
	
	if(isset($_GET["hasVideo"])){
		$hasVideo = true;
	}else{
		$hasVideo = false;
	}
	if(isset($_GET["onlyApproved"])){
		$onlyApproved = true;
	}else{
		$onlyApproved = false;
	}
	
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	
	$sql0 = "SELECT * FROM permission 
			WHERE title='" . $_COOKIE["title"] . "'";
	$result0 = mysqli_query($db,$sql0) or die("SQL error!<br>");
	$row0 = mysqli_fetch_array($result0, MYSQLI_ASSOC);
	
	if($row0["readVocab"]==0){
		echo "<script>alert('Your trial period has expired, please subscribe a plan to continue visit this website.');
		window.location.href='index.php';</script>";
	}
	
	$sql = "SELECT * FROM vocabulary WHERE vocabName ='" . $content . "'";
	
	if($hasVideo){
		$sql = $sql . " AND videoSource!=''";
	}
	if($onlyApproved){
		$sql = $sql . " AND status='approved'";
	}
	
	$result = mysqli_query($db,$sql) or die("SQL error!<br>");
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if($row!=false){
		$vocabId = $row['vocabId'];
    	$submitter = $row['submitter'];
		$approver = $row['approver'];
		$vocabName = $row['vocabName'];
		$description = $row['description'];
		$videoSource = $row['videoSource'];
		$checkTotal = $row['checkTotal'];
		
		$sql2 = "UPDATE vocabulary SET checkTotal=checkTotal+1 WHERE vocabId='" . $vocabId . "'";
		mysqli_query($db,$sql2) or die("SQL error!<br>");
		$sql3 = "INSERT INTO checkinghistory(email,vocabId,vocabName,checkTime) VALUES('" . $_COOKIE['email'] . "','" . 
				$vocabId . "','" . $vocabName . "','" . date('Y-m-d') . "')";
		mysqli_query($db,$sql3) or die("SQL error!<br>");	
		$sql4 = "SELECT * FROM addingtoglossaryhistory WHERE vocabId='" . $vocabId . "' AND email='" . $_COOKIE['email'] . "'";
		$result2 = mysqli_query($db,$sql4) or die("SQL error!<br>");
		$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
		if($row2==false){
			$alreadyAddToGlossary = false;
		}else{
			$alreadyAddToGlossary = true;
		}
	}
	else{
		header("Location: noResult.php");
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
$(document).ready(function(){
	$("input").on("input",function(){
		$("datalist").empty();
		$.post("scripts/searchVocabWithInitials.php",
        	{content:$("input").val()},
        	function(data,status){
        		$("datalist").append("<option value=" + data + ">");
        	});
	});
})

function DropDown(){
	$(".dropDownContent").slideToggle("fast");
};

function add(){
	$.post("scripts/addToGlossary.php",
        {
			vocabId:<?php echo $vocabId?>,
			vocabName: "<?php echo $vocabName?>"
		},
        function(data,status){
			$("#addToGlossary").text("Added");
		});
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>

<body>
	<?php require('header.php');?>

	<div class="mainFrame">
    	<h1><?php echo $vocabName;?></h1>
    	<table class="defaultTable">
			<tr>
				<td>Uploader:</td>
          		<td width="2000"><?php echo $submitter;?></td>
			</tr>

			<tr>
				<td>auditor:</td>
       			<td><?php echo $approver;?></td>
			</tr>

			<tr>
				<td>description:</td>
       			<td><?php echo $description;?></td>
			</tr>

			<tr>
				<td>checkTotal:</td>
       			<td><?php echo $checkTotal;?></td>
			</tr>
		</table>
            
        <video width="600" height="600" controls>
 		 <source src="<?php echo $videoSource;?>" type="video/mp4">
		</video><br><br>
        
        <div id="addToGlossary">
        <?php 
			if($alreadyAddToGlossary){
				echo "Added";
			}else{
				echo "<a href='javascript:add()'>Add to my vocabulary list!</a>";
			}
		?>
        </div>
	</div>
	
	<?php require('footer.php');?>

</body>
</html>
