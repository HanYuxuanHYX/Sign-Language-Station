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
		<table class="defaultTable">
        	<tr>
            	<td><img src="img/yangchaoyue.jpg"></td>
                <td>Jimmy</td>
                <td>+85266425731</td>
            </tr>
            <tr>
            	<td><img src="img/yangchaoyue.jpg"></td>
                <td>Hans</td>
                <td>+85254647594</td>
            </tr>
            <tr>
            	<td><img src="img/yangchaoyue.jpg"></td>
                <td>incandescentxxc</td>
                <td>+85260930342</td>
            </tr>
            <tr>
            	<td><img src="img/yangchaoyue.jpg"></td>
                <td>Po</td>
                <td>+85261122109</td>
            </tr>
            <tr>
            	<td><img src="img/yangchaoyue.jpg"></td>
                <td>Jason</td>
                <td>+85295615069</td>
            </tr>
            <tr>
            	<td><img src="img/yangchaoyue.jpg"></td>
                <td>Kyletuet</td>
                <td>+85251141210</td>
            </tr>
        </table>
		</p>
	</div>
	
	<?php require('footer.php');?>
</body>
</html>
