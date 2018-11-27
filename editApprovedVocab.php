<?php
	if(!isset($_COOKIE["email"]))
		header("Location: login.php");
	
	$conn = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($conn,"18012633x");
	
	// $searchUserID = $_POST['searchUserID'];
	// $daysLeft = "SELECT daysLeft FROM member WHERE username=?";
	// if($stmt = mysqli_prepare($link, $daysLeft)) {
	// 	mysqli_stmt_bind_param($stmt, "s", $searchUserID);
	// 	mysqli_stmt_execute($stmt);
	// 	mysqli_stmt_close($stmt);
	// 	echo '<table>
	//         <tr><th>username</th><th>days left</th><tr>
	// 	    <tr><td>'.$searchUserID.'</td><td>'.$daysLeft.'</td></tr>
	//     </table>';
	// 	echo '<form>
	// 	    <tr>
	// 			<td><input type="submit" name="delete" id="delete"></td>
	// 		</tr>
	// 	</form>';
	//}
	
	$sql1 = "SELECT * FROM permission WHERE title='" . $_COOKIE["title"] . "'";
	$result1 = mysqli_query($conn,$sql1) or die("SQL error!<br>");
	$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);	
	if($row1["editApprovedVocab"]==0){
		mysqli_close($conn);
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
	font-size:15px;
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;	
}
th{
	height:60px;
	font-size:14px;
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	text-align:left;
}
</style>
</head>
<body>
	<?php require('header.php');?>
	<div class="mainFrame">
	<input type="text" id="myInput" onKeyUp="myFunction()" placeholder="Search vocabulary by name.." >
	<table id="myTable" width=auto;>
	  <tr>
	    <th width="300px"><strong>submitter</strong></th>
		
	    <th width="300px"><strong>approver</strong></th> 
	    <th width="200px"><strong>status</strong></th>
	    <th width="200px"><strong>vocabname</strong></th>

	    <th width="500px"><strong>description</strong></th>

	    <th width="200px"><strong>videoSource</strong></th>
	    <th width="100px"><strong>checkTotal</strong></th>
	    <th width="100px"><strong>addTotal</strong></th>
	    <th width="100px"><strong>delete</strong></th>
	    <th width="400px"><strong>edit description</strong></th>
        <th width="400px"><strong>edit video source</strong></th>
	  </tr>

	<?php 
	$sql = "SELECT * FROM vocabulary WHERE status='approved';";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
    	// output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	        echo '<tr><td>' . $row["submitter"]. '</td><td>'
			. $row["approver"].'</td><td>'
			. $row["status"]. '</td><td>'
			. $row["vocabName"]. '</td><td>'
			. $row["description"]. '	</td><td>'
			. $row["videoSource"]. '</td><td>'
			. $row["checkTotal"]. '</td><td>'
			. $row["addTotal"]. '</td><td>' 
			. "<a href='scripts/deleteVocab.php?vocabId=".$row['vocabId']."'>delete</td><td>
			<form action='scripts/updateDescription.php' method='post'>
			<input type='text' name='description' >
			<input type='submit' value='Submit'>
			<input type='hidden' name='vocabId' value=".$row['vocabId']."></form></td>"
			. "<td><form action='scripts/updateVideoSource.php' method='post'>
			<input type='text' name='videoSource'>
			<input type='submit' value='Submit'>
			<input type='hidden' name='vocabId' value=".$row['vocabId']."></form></td>";
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
		    td = tr[i].getElementsByTagName("td")[3];
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





	<script>
	$(document).ready(function(){  
	     $('#editable_table').Tabledit({
	      url:'action.php',
	      columns:{
	       identifier:[0, "id"],
	       editable:[[1, 'first_name'], [2, 'last_name']]
	      },
	      restoreButton:false,
	      onSuccess:function(data, textStatus, jqXHR)
	      {
	       if(data.action == 'delete')
	       {
	        $('#'+data.id).remove();
	       }
	      }
	     });
	 
	});  
	 </script>







<!-- 	    <form id="form2" name="form2" method="post">
	        Please search:
		    <tr>
		        <td><label for="searchUserID">UserID</label></td>
		    	<td><input type="text" required name="searchUserID" id="searchUserID" placeholder="Username"></td>
		    </tr>
			
			<tr>
				<td><input type="submit" name="Submit" id="Submit"></td>
			</tr>
		</form> -->
	</div>
	
	<?php require('footer.php');?>
</body>
</html>
