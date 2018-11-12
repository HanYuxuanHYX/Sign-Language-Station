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
		<h1>You have only one step left!<br></h1>
	  	<h2>Please confirm the email address you input for signing up, click on the link in your email to finish signing up<br></h2>
	  	Didnnot receive email？ Click on <a href="scripts/resendEmail.php"></a>for resending.
	</div>
	
	<?php require('footer.php');?>

</body>
</html>
