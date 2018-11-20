<?php
	if(!isset($_COOKIE["username"]))
		header("Location: login.php");
	if(isset($_POST["submit"])){
		if ($_FILES["file"]["error"] > 0){
    		echo "Error：" . $_FILES["file"]["error"] . "<br>";
		}
		move_uploaded_file($_FILES["file"]["tmp_name"], "videos/upload/" . $_FILES["file"]["name"]);
		/*interaction with database*/
		$submitter = $_COOKIE["email"];
		/*eliminate the postfix of the file*/
		$fileName_post = $_FILES["file"]["name"];
		$fileName = $_FILES["file"]["name"];
		$str1 = strrchr($fileName,"."); 
        if($str1){ 
  			$fileName = trim($fileName,$str1); 
		}  
		$description = $_POST["descri"];
		$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
		if(!$db){
			 die("Connection failed: " . mysqli_connect_error());
		}
		mysqli_select_db($db,"18012633x");
		$sql = "insert into vocabulary(submitter,approver,status,vocabName,description,videoSource,checkTotal,addTotal)
		values('$submitter','1767182376@qq.com','unapproved','$fileName','$description','videos/upload/','0','0')";
		if(mysqli_query($db,$sql)){
			echo "<script>alert('Video uploaded successfully!')</script>";

		} else {
    		echo "Error: " . $sql . "<br>" . mysqli_error($db);
		}
		
		
		
		mysqli_close($db);
		
		
		
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Language Station</title>
<link rel="stylesheet" type="text/css" href="top_bottom_list.css"/>
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
	Please upload the file:
	<form action="upload.php" method="post"
		enctype="multipart/form-data">
		<label for="file">Filename:</label>
		<input type="file" name="file" id="file" /> 
		<br />
		Please enter your language description:
		<input type = "text" name = "descri"  />
		<br />
		<input type="submit" name="submit" value="Submit" />
	</form>
	</div>
	
	<?php require('footer.php');?>
</body>
</html>
