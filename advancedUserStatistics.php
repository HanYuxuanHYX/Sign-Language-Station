<?php
if(!isset($_COOKIE["username"])){
		header("Location: login.php");
		exit;
	}	
	require_once 'connect_db.php';
	mysqli_select_db($db,"18012633x");
	
	$sql0 = "SELECT * FROM permission 
			WHERE title='" . $_COOKIE["title"] . "'";
	$result0 = mysqli_query($db,$sql0) or die("SQL error!<br>");
	$row0 = mysqli_fetch_array($result0, MYSQLI_ASSOC);
	
	if($row0["statistics"]==0){
		mysqli_close($db);	
		echo "<script>alert('You do not have the authority to do this!');
		window.location.href='adminFunctions.php';</script>";
	}
		$sql1 = "select userName, email, daysLeft
				from member
where member.daysLeft < 30
order by daysLeft";
	$result1 = mysqli_query($db,$sql1);
	
	$sql2 = "select member.userName, member.email, sum(price)
from subscriptionplan, payment, member
where subscriptionplan.planId = payment.planId
and payment.email = member.email
group by member.email
order by sum(price) DESC";
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
	<h3>The sorted dayleft of users:</h3>
	<?php
	if (mysqli_num_rows($result1) > 0){
		echo'<ol>';
		for($x = 0;$x<5;$x++){
			$row = mysqli_fetch_assoc($result1);
			echo '<li>';
    	echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#000000'>User Name: </span>";
    	echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#0099cc'>".$row['userName']."</span>";
    	echo "<br>";
    	echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#000000'>User Email: </span>";
    	echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#0099cc'>".$row['email']."</span>";
    	echo "<br>";
    	echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#000000'>The days left:</span>";
    	echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#0099cc'>".$row['daysLeft']."</span>";
    	echo '</li><br>';
				
		}
		echo'</ol>';
	}
	else{
		echo "No result!";
	}
		?>
	<hr>
		<h3>The customers who spend the most (Top5)</h3>
		<?php
			if(mysqli_num_rows($result2)>0){
				echo'<ol>';
					for($x=0;$x<5;$x++){
						$row = mysqli_fetch_assoc($result2);
						echo'<li>';
						echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#000000'>User Name: </span>";
    					echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#0099cc'>".$row['userName']."</span>";
    					echo "<br>";
    					echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#000000'>User Email: </span>";
    					echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#0099cc'>".$row['email']."</span>";
    					echo "<br>";
    					echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#000000'>Total money the user spend:</span>";
    					echo "<span style ='font:15px Lucida Sans Unicode, Lucida Grande, sans-serif;color:#0099cc'>".$row['sum(price)']."</span>";
    					echo '</li><br>';
							
					}
					echo'</ol>';
			}
			else{
				echo "No result!";
			}
			?>
	
	
		
	
	<?php require('footer.php');?>

</body>
</html>