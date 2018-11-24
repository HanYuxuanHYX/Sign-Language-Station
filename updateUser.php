<?php
	if(!isset($_COOKIE["username"]))
		header("Location: login.php");
	
	$conn = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($conn,"18012633x");
	
	$sql1 = "SELECT * FROM permission WHERE title='" . $_COOKIE["title"] . "'";
	$result1 = mysqli_query($conn,$sql1) or die("SQL error!<br>");
	$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);	
	if($row1["writeMember"]==0){
		echo "<script>alert('You do not have the authority to do this!');
		window.location.href='adminFunctions.php';</script>";
	}
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
	$(".dropDown").click(function(){
    	$(".dropDownContent").slideToggle("slow");
    });
})
</script>
<style>
td{
	height:60px;
	font-size:16px;
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;	
}
th{
	height:60px;
	font-size:16px;
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	text-align:left;
}
</style>
</head>
<body>
	<?php require('header.php');?>
	<div class="mainFrame">
	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search email.." >
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
	    <th width="100px"><strong>deleteUser</strong></th>
	    <th width="600px"><strong>edit days lef</strong>t</th>
	  </tr>

	<?php 
	$sql = "SELECT * FROM 18012633x.member;";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
    	// output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	        echo '<tr><td>' . $row["email"]. '</td><td>'
			. $row["userName"].'</td><td>'
			. $row["password"]. '</td><td>'
			. $row["birthday"]. '</td><td>'
			. $row["disability"]. '	</td><td>'
			. $row["title"]. '</td><td>'
			. $row["registerDate"]. '</td><td>'
			. $row["activated"]. '</td><td>'
			. $row["daysLeft"]. "</td><td>
	        <a href='scripts/deleteUser.php?email=".$row['email']."'>delete</td><td>
			<form action='scripts/updateDaysLeft.php' method='post'>
			<input type='text' name='daysLeft' >
			<input type='submit' value='Submit'><input type='hidden' name='email' value=".$row['email'].">
			</form>
	        </td>";
	    }
	}
	mysqli_close($conn);
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
		    td = tr[i].getElementsByTagName("td")[0];
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
	</div>
	
	<?php require('footer.php');?>
</body>
</html>