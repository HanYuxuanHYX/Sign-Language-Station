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
</script>
</head>

<body>
	<?php require('header.php');?>

	<div class="mainFrame">
		<img src="logo/sign.jpg" /> <br>
	  	<form id="form1" name="form1" method="get" action="vocabInfo.php">
	  	<input type="text" list="searchList" name="content"> 
        <datalist id="searchList">
        </datalist>
	  	<input type="submit" name="submit" id="submit" value="search">
	  	</form>
	</div>
	
	<?php require('footer.php');?>

</body>
</html>