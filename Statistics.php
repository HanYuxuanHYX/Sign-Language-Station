<?php
	if(!isset($_COOKIE["email"])){
		header("Location: login.php");
		exit;
	}
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
			if(!$db){
				 die("Connection failed: " . mysqli_connect_error());
			}
			mysqli_select_db($db,"18012633x");
	
	
	$sql1 = "SELECT vocabulary.vocabName, COUNT(checkId) AS totalCheck
FROM vocabulary, checkinghistory
WHERE vocabulary.vocabId = checkinghistory.vocabId
GROUP by vocabName
Order by totalCheck DESC"; 
	$result1 = mysqli_query($db, $sql1);
	$sql2 = "SELECT member.userName, member.email, COUNT(vocabId) AS totalSubmit
FROM member, vocabulary
WHERE vocabulary.submitter = member.email
Group by member.email
Order By totalSubmit DESC
	";
	$result2 = mysqli_query($db,$sql2);
	
	
	mysqli_close($db);	
	
		
	
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
	<h3>Top 10 popular words are(In the past month):</h3>
	<?php
			if (mysqli_num_rows($result1) > 0) {
	echo'<ol>';
    for($x= 0;$x<10;$x++){
    	$row = mysqli_fetch_assoc($result1);
    	
    	echo '<li>';
    	echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#000000'>Vocabulary Name:";
    	echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#0099cc'>"
    		.$row['vocabName']."</span>";
    	echo "<br>";
    	echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#000000'>TotalCheckNumber:   </span>";
    	echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#0099cc'>"
    		.$row['totalCheck']."</span>";
    	echo '</li><br>';
    }
    echo'</ol>';
  
} else {
    echo "No result!";
}
		?>
		
		

	
	<hr>
	<h3>Top 3 users with highest contributions(In the past month):</h3>
	<?php 
		
	if (mysqli_num_rows($result2) > 0) {
	echo'<ol>';
    for($x= 0;$x<3;$x++){
    	$row = mysqli_fetch_assoc($result2);
    	echo '<li>';
    	echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#000000'>User Name: </span>";
    	echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#0099cc'>".$row['userName']."</span>";
    	echo "<br>";
    	echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#000000'>User Email: </span>";
    	echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#0099cc'>".$row['email']."</span>";
    	echo "<br>";
    	echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#000000'>Total Submit Successfully number:  </span>";
    	echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#0099cc'>".$row['totalSubmit']."</span>";
    	echo '</li><br>';
    }
    echo '</ol>';
  
} else {
    echo "No result!";
}?>

	
		
	
	<?php require('footer.php');?>

</body>
</html>
