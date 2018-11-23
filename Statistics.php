<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Language Station</title>
<link rel="stylesheet" type="text/css" href="css/general.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("input").on("input",function(){
		$("datalist").empty();
		$.post("scripts/searchVocabWithInitials.php",
        	{content:$("input").val()},
        	function(data,status){
				var arr = data.split(",");
				var i;
				var len = arr.length;
				for(i = 0 ; i < len ; i++){
        			$("datalist").append("<option value=" + arr[i] + ">");
				}
        	});
	});
})
function DropDown(){
	$(".dropDownContent").slideToggle("fast");
};
</script>
</head>

<body>
	<?php require('header.php');?>
	
	
	
	<?php require('footer.php');?>

</body>
</html>