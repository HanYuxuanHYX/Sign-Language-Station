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

	<h1>Sorry, we can't find your vocabulary. Please untick some of the filter options or search another word.</h1>
    <br><br><br>
    <a href="index.php">back to main page</a>
	
	<?php require('footer.php');?>

</body>
</html>