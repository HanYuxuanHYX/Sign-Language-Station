<?php
	if(!isset($_COOKIE["email"])){
		header("Location: login.php");
		exit;
	}
	
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	$sql0 = "SELECT * FROM permission WHERE title='" . $_COOKIE["title"] . "'";
	$result0 = mysqli_query($db,$sql0) or die("SQL error!<br>");
	$row0 = mysqli_fetch_array($result0, MYSQLI_ASSOC);
	
	if($row0["uploadVocab"]==0){
		mysqli_close($db);
		echo "<script>alert('You do not have the authority to do this!');
		window.location.href='index.php';</script>";
		exit;
	}
	
	if(isset($_POST["submit"])){

		$target_dir = "videos/";
		$target_file = $target_dir . basename($_FILES["file"]["name"]);
		
		$videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		if (filesize($_FILES['file']['tmp_name'])==false){
			echo "<script>alert('You have not uploaded any video!')</script>";
		}
		
		else if ($_FILES["file"]["error"] > 0){
    		echo "<script>alert('Error:" . $_FILES["file"]["error"] . "')</script>";
		}
		
		else if($videoFileType != "mp4" ) {
    		echo "<script>alert('Sorry, only mp4 format is supported.')</script>";	
		}
		
		else{
			move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
			
			$submitter = $_COOKIE["email"];
			$vocabName = $_POST["vocabName"];
			$description = $_POST["descri"];

			$sql = "insert into vocabulary(submitter,approver,status,vocabName,description,videoSource,checkTotal,addTotal)
			values('$submitter','tmp','unapproved','$vocabName','$description','videos/" . $_FILES["file"]["name"] . "','0','0')";
			if(mysqli_query($db,$sql)){
				echo "<script>alert('Your submission has successfully sent to the admins of the website! Thanks for your effort!')</script>";
			} else {
    			echo "Error: " . $sql . "<br>" . mysqli_error($db);
			}
					
			mysqli_close($db);	
		}
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
	<form action="upload.php" method="post" enctype="multipart/form-data">
    	<table class="defaultTable">
        <tbody>
        <tr>
        	<td>Vocabulary Name:</td>
            <td><input type="text" name="vocabName" id="vocabName"/></td>
		</tr>
        <tr>
			<td>Text description of how to perform the sign:</td>
			<td><textarea name="descri"></textarea></td>
		</tr>
        <tr>
			<td>Video(only .mp4 format is supported):</td>
			<td><input type="file" name="file" id="file"/></td>
        </tr>
        <tr>
			<td colspan="2"><input type="submit" name="submit" value="Submit" /></td>
        </tr>
        </tbody>
        </table>
	</form>
	</div>
	
	<?php require('footer.php');?>
</body>
</html>
