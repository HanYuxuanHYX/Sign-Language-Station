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
function DropDown(){
	$(".dropDownContent").slideToggle("fast");
};
</script>
</head>
<body>
	<?php require('header.php');?>
	
	<div class="mainFrame">
		<p style="width: 75%;">
		Sign languages are natural languages that have the same linguistic properties as spoken languages.
		Like spoken language, sign languages vary in different countries. One sign language may have more than one 
		meaning. Some spoken language may not have a sign language.<br><br>
		Rationale of station:<br><br>
		With the ever accelerated development of public welfare and social benefit, more and more people are paying attention to the 
		living conditions of the disabled. The very first obstacle for deaf people to have a normal life is the disability to communicate
		with others, there is no doubt that the generalization of sign language is of great importance in improving their living conditions.<br><br>
                However, currently we are lacking an online platform for the public to access to the education of sign language even though they want to learn.
		There are few self-learning accesses whereas our society is lacking members able to communicate with the deaf. 
		The traditional way of training is of low efficiency thus fails to fulfill the actual need. 
		That’s why we are convinced that a self learning tool for sign language is in demand.<br><br>
        
		How sign language in Hong Kong come from?<br>
		As sign language are uncommon, there is a lack of of sign language. Also, sign language changes as time pass.
		School may change some of the usual sign language for teaching purpose.<br><br>
		
		Purpose of station:<br>
		*Improve sign language dictionary to help deaf people<br>
		*Promote sign language in Hong Kong<br>
		*Improve communication skill between deaf and non deaf<br>
		</p>
	</div>s
	
	<?php require('footer.php');?>
</body>
</html>
