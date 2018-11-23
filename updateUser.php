<?php
	if(!isset($_COOKIE["username"]))
		header("Location: login.php");
	
	//connect
	$servername = "sdmysql.comp.polyu.edu.hk";
    $username = "18012633x";
    $password = "sqgqcbvd";
    $dbname = "18012633x";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysql_connect_error());
    }



	
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
	
	
	
?>


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
})
</script>
</head>
<body>
	<?php require('header.php');?>
	<div class="mainFrame">


	

	All Users:
	<style>
	table,th,td{
    border: 1px solid black;
    border-collapse: collapse;
	}
	</style>
	<table style="width:100%" id="myTable">
	  <tr>
	    <th>email</th>
	    <th>userName</th> 
	    <th>password</th>
	    <th>birthday</th>
	    <th>disability</th>
	    <th>title</th>
	    <th>registerDate</th>
	    <th>activated</th>
	    <th>daysLeft</th>
	    <th>deleteUser</th>
	    <th>edit days left</th>
	  </tr>

	<?php 
	$sql = "SELECT * FROM 18012633x.member;";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
    	// output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	        echo '<tr><td>' . $row["email"]. '</td><td>' . $row["userName"].'</td><td>' . $row["password"]. '</td><td>' . $row["birthday"]. '</td><td>' . $row["disability"]. '</td><td>' . $row["title"]. '</td><td>' . $row["registerDate"]. '</td><td>' . $row["activated"]. '</td><td>' . $row["daysLeft"]. "</td><td>
	        <a href='scripts/deleteUser.php?email=".$row['email']."'>delete</td>
	        <td><form action='scripts/updateDaysLeft.php' method='post'><input type='text' name='daysLeft' ><input type='submit' value='Submit'><input type='hidden' name='email' value=".$row['email'].">   </form>
	        </td>"
	        ;
	    }
	}
	?>
	
	</tr>
	</table>
	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search userName.." >
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
