<?php require('header.php');?>
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
<div class="center">
<table class="defaultTable">
<tbody>
	<tr><td><b>vocab functions:</b></td></tr>
	<tr><td><a class="approveVocLink" href="approveUploadedVocab.php">Edit Unapproved Vocabulary</a></td>
		<td><a class="editVocaLink" href="editApprovedVocab.php"> Edit Approved Vocabulary </a></td></tr>
	<tr><td><b>member functions:</b></td></tr>
	<tr><td><a class="readMember" href="readMember.php" >Read Member</a></td>
		<td><a class="modifyCustomerLink" href="updateUser.php"> Write Member</a></td></tr>
	<tr><td><b>statistics:</b></td></tr>
	<tr><td><a class="viewPaymentRecordLink" href="viewSubscriptionPlanHistory.php"> Payment Record </a></td>
		<td><a class="showClickingTableLink" href="showClickingTable.php"> Checking History For Each Vocab</a></td></tr>
        </tbody>
        </table>

</div>
<?php require('footer.php');?>
</body>
</html>