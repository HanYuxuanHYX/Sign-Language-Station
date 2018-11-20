<?php
	if(!isset($_COOKIE["username"]))
		header("Location: login.php");
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
	$(".dropDown").onmouseenter(function(){
    	$(".dropDownContent").slideDown("slow");
    });
	
	$(".dropDown").onemouseleave(function(){
    	$(".dropDownContent").slideUp("slow");
    });
})
</script>
</head>
<body>
	<?php require('header.php');?>
	
	<div class="mainFrame">
		wait to be finished...
	</div>s
	
	<?php require('footer.php');?>
</body>
</html>
