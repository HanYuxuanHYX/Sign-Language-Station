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
		<h1>The new password has been sent to your email address!<br></h1>
	  	Please confirm the email address you input for signing up to get the new password. After signing in using the new password, you can change the password under "account function"--"personal information".<br>
	</div>
	
	<?php require('footer.php');?>

</body>
</html>
