<?php
	session_start();
	require_once 'connect_db.php';
	if(!isset($_COOKIE["username"]) && !isset($_COOKIE["email"]) )
		header("Location: login.php");
	
	
	if(!isset($_POST["vocabMonth"]) && !isset($_POST['svocabID']))
	{
		echo "Cannot obtain the user information. Please connect to the IT department.";
	}
	
	$vmonth = $_POST["vocabMonth"];
	$smonethEnd = $vmonth . "-31";
	$smonethStart = $vmonth ."-01";
	$svocabID = $_POST['svocabID'];
	
	
	echo "
	  <body>
	  <div id = 'vocabCheckingUserDetailContainer' style = ' height: 200px; margin: 70 auto'></div>
	  <script language = 'JavaScript'>
	  function drawTableUserChart() {
            var vocabUserData = new google.visualization.DataTable();
             vocabUserData.addColumn('string', 'Vocabulary Name ');
            vocabUserData.addColumn('string', 'Vocabulary ID');
			vocabUserData.addColumn('string', 'Number of Checking');
            vocabUserData.addColumn('string', 'Check Date');
			vocabUserData.addColumn('string', 'User Email');
			vocabUserData.addColumn('string', 'User Name');
			vocabUserData.addColumn('string', 'User Birthday');
			vocabUserData.addColumn('string', 'User Disability');
			vocabUserData.addColumn('string', 'User Title');
			vocabUserData.addColumn('string', 'User Register Date');
			vocabUserData.addColumn('string', 'User Day Left');
            vocabUserData.addRows([";
			require_once 'connect_db.php';
					
					$findVocabDetail = "SELECT checkinghistory.vocabName, checkinghistory.vocabId, COUNT(checkinghistory.email) AS checkNumber,checkinghistory.checkTime,  member.email , member.userName , member.birthday, member.disability, member.title, member.registerDate, member.daysLeft
FROM member, checkinghistory 
WHERE member.email = checkinghistory.email 
AND checkinghistory.checkTime >= ? AND checkinghistory.checkTime <= ? AND checkinghistory.vocabId = ?  GROUP BY checkinghistory.email ORDER BY checkNumber DESC ;";
					
					if($stmt = mysqli_prepare($link, $findVocabDetail))
					{
						
						mysqli_stmt_bind_param($stmt, "sss",  $smonethStart, $smonethEnd, $svocabID);
						
						mysqli_stmt_execute($stmt);
						
						 mysqli_stmt_bind_result($stmt, $vocabName , $vocabId, $checkNumber, $checkTime, $email, $userName, $birthday, $disability, $title, $registerDate, $daysLeft   );
						 
						 while(mysqli_stmt_fetch($stmt)){
								echo "['".$vocabName."', '".$vocabId."', '".$checkNumber."', '".$checkTime."', '".$email."', '".$userName."', '".$birthday."', '".$disability."', '".$title."', '".$registerDate."', '".$daysLeft."'],";
							}
						mysqli_stmt_close($stmt);
						
					}else
					{
						echo "Cannot obtain the user information. Please connect to the IT department.";
					}
	echo "]);";
	
	echo "var checkingHistoryUserOptions = {
               showRowNumber: true,
               width: '100%', 
               height: '100%',
               pageSize: 5
            };
			
			var detailUserchart = new google.visualization.Table(document.getElementById('vocabCheckingUserDetailContainer'));
		
            detailUserchart.draw(vocabUserData, checkingHistoryUserOptions);
         
			
			}
			google.charts.setOnLoadCallback(drawTableUserChart);
			
			
			
			
			</script>
			<div id = 'vocabCheckingUserDetailPieContainer' style = 'width: 900px; height: 500px; margin: auto'></div>
			<script language = 'JavaScript'>
					function drawTableUserPieChart() {
						var pieData = google.visualization.arrayToDataTable([
							['Disability', 'User Number'],";
							require_once 'connect_db.php';
					
							$findVocabPieDetail = "SELECT DISTINCT(member.disability), COUNT(member.disability) FROM member, checkinghistory  WHERE member.email = checkinghistory.email 
							AND checkinghistory.checkTime >= ? AND checkinghistory.checkTime <= ? AND checkinghistory.vocabId = ?  
							GROUP BY member.disability";
							
							if($stmt2 = mysqli_prepare($link, $findVocabPieDetail))
							{
						
								mysqli_stmt_bind_param($stmt2, "sss",  $smonethStart, $smonethEnd, $svocabID);
						
								mysqli_stmt_execute($stmt2);
						
								mysqli_stmt_bind_result($stmt2, $disabilityName, $countDisability   );
						 
								while(mysqli_stmt_fetch($stmt2)){
										echo "['".$disabilityName."', ".$countDisability."],";
								}
								mysqli_stmt_close($stmt2);
						
								mysqli_close($link);
							}else
							{
								echo "Cannot obtain the user information. Please connect to the IT department.";
							}	
							
							
						echo "]);";
						
						echo "var pieOptions = {
										title: 'The Proportion of user with different disability to search word : ".$vocabName."',
										is3D: true
									};";
						
						
						echo "var pieChart = new google.visualization.PieChart(document.getElementById('vocabCheckingUserDetailPieContainer'));";
						
						echo "pieChart.draw(pieData, pieOptions);";
						
						echo "}";
						echo "google.charts.setOnLoadCallback(drawTableUserPieChart);";
						
			echo "</script>";
			echo "</body>";
			
?>