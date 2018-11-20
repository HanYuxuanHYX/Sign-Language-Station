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
		<h1>One step left!<br></h1>
	  	Please confirm the email you use for signing, click the link in your email to reset password<br>
	</div>
	
	<?php require('footer.php');?>

</body>
</html>
