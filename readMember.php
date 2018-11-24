<?php 
	if(!isset($_COOKIE["email"])){
		header("Location: login.php");
		exit;
	}
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	$sql1 = "SELECT readMember FROM member,permission 
			WHERE member.title=permission.title AND
			email='" . $_COOKIE["email"] . "'";
	$result1 = mysqli_query($db,$sql1) or die("SQL error!<br>");
	$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
	if($row1["readMember"]!=1){
		echo "<script>alert('You do not have the authority to do this!');
			window.location.href='adminFunctions.php';</script>";
	}
require('footer.php');
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
<style>
td{
	height:80px;
	font-size:14px;
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;	
}
th{
	height:60px;
	font-size:16px;
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	text-align:left;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>

<body>
	<?php require('header.php');?>

	<div class="mainFrame">


	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search userName.." ><br>
	All Users:

	<table id="myTable" width=auto;>
          	<tr>
			    <th width="300px"><strong>email</strong></th>
			    <th width="200px"><strong>userName</strong></th> 
			    <th width="300px"><strong>password</strong></th>
			    <th width="200px"><strong>birthday</strong></th>
			    <th width="100px"><strong>disability</strong></th>
			    <th width="200px"><strong>title</strong></th>
			    <th width="200px"><strong>registerDate</strong></th>
			    <th width="50px"><strong>activated</strong></th>
			    <th width="100px"><strong>daysLeft</strong></th>
            </tr>
          	<?php 
	$sql = "SELECT * FROM 18012633x.member;";
	$result = mysqli_query($db, $sql);
	if (mysqli_num_rows($result) > 0) {
    	// output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	        echo '<tr><td>' 
	        . $row["email"]. '</td><td>' 
	        . $row["userName"].'</td><td>' 
	        . $row["password"]. '</td><td>' 
	        . $row["birthday"]. '</td><td>' 
	        . $row["disability"]. '</td><td>' 
	        . $row["title"]. '</td><td>' 
	        . $row["registerDate"]. '</td><td>' 
	        . $row["activated"]. '</td><td>' 
	        . $row["daysLeft"]. "</td>"
	        ;
	    }
	}
	?>


	</tr>
	</table>

	<script>
		function myFunction() {
		  var input, filter, table, tr, td, i;
		  input = document.getElementById("myInput");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("myTable");
		  tr = table.getElementsByTagName("tr");
		  for (i = 0; i < tr.length; i++) {
		    td = tr[i].getElementsByTagName("td")[1];
		    if (td) {
		      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
		        tr[i].style.display = "";
		      } else {
		        tr[i].style.display = "none";
		      }
		    }       
		  }
		}
	</script>

	<?php mysqli_close($db);?>
	</div>
	
	<?php require('footer.php');?>
</body>
</html>
