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
		<h1>You have only one step left!<br></h1>
	  	<h2>Please confirm the email address you input for signing up, click on the link in your email to finish signing up<br></h2>
	  	<font size="+2">Haven't received an email? Click <a href="scripts/resendEmail.php">here</a> for resending.</font>
	</div>
	
	<?php require('footer.php');?>

</body>
</html>
