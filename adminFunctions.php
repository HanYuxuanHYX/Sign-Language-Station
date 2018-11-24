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
<style>
.center {
    margin: auto;
    width: 90%;
    padding: 5px
}
.approveVoc
{
    width: 100%;
    padding: 20px;
}
.reviewReport
{
    width: 100%;
    padding: 20px;
}
.modifyCustomer
{
    width: 100%;
    padding: 20px;
}
.editVoc
{
    width: 100%;
    padding: 20px;
}
.viewPaymentRecord
{
    width: 100%;
    padding: 20px;
}
.showClickingTable
{
    width: 100%;
    padding: 20px;
}
a.approveVocLink {
    background-color: #009999;
    box-shadow: 0 5px #888888;
    color: white;
    padding: 1em 1.5em;
    position: relative;
    text-decoration: none;
    text-transform: uppercase;
}
a.approveVocLink:hover {
  background-color: #669999;
  cursor: pointer;
}
a.approveVocLink:active {
  box-shadow: none;
  top: 5px;
}
a.reviewReportLink {
    background-color: #3333cc;
    box-shadow: 0 5px #888888;
    color: white;
    padding: 1em 1.5em;
    position: relative;
    text-decoration: none;
    text-transform: uppercase;
}
a.reviewReportLink:hover {
  background-color: #666699;
  cursor: pointer;
}
a.reviewReportLink:active {
  box-shadow: none;
  top: 5px;
}
a.modifyCustomerLink {
    background-color: #993366;
    box-shadow: 0 5px #888888;
    color: white;
    padding: 1em 1.5em;
    position: relative;
    text-decoration: none;
    text-transform: uppercase;
}
a.modifyCustomerLink:hover {
  background-color: #cc6699;
  cursor: pointer;
}
a.modifyCustomerLink:active {
  box-shadow: none;
  top: 5px;
}
a.editVocaLink {
    background-color: #0066cc;
    box-shadow: 0 5px #888888;
    color: white;
    padding: 1em 1.5em;
    position: relative;
    text-decoration: none;
    text-transform: uppercase;
}
a.editVocaLink:hover {
  background-color: #3366cc;
  cursor: pointer;
}
a.editVocaLink:active {
  box-shadow: none;
  top: 5px;
}
a.viewPaymentRecordLink{
    background-color: #0099cc;
    box-shadow: 0 5px #888888;
    color: white;
    padding: 1em 1.5em;
    position: relative;
    text-decoration: none;
    text-transform: uppercase;
}
a.viewPaymentRecordLink:hover {
  background-color: #4db8ff;
  cursor: pointer;
}
a.viewPaymentRecordLink:active {
  box-shadow: none;
  top: 5px;
}
a.showClickingTableLink{
    background-color: #FF6633;
    box-shadow: 0 5px #888888;
    color: white;
    padding: 1em 1.5em;
    position: relative;
    text-decoration: none;
    text-transform: uppercase;
}
a.showClickingTableLink:hover {
  background-color: #FFCC66;
  cursor: pointer;
}
a.showClickingTableLink:active {
  box-shadow: none;
  top: 5px;
}
</style>

</head>
<body>
<div class="center">
<div class ="approveVoc"><a class="approveVocLink" href="approveUploadedVocab.php">Approve Uploaded Vocabulary</a></div>
<div class="editVoc"><a class="editVocaLink" href="editApprovedVocab.php"> Edit Vocabulary </a></div>
<div class ="reviewReport"><a class="reviewReportLink" href="" >Generate Viewing History Report</a></div>
<div class="modifyCustomer"><a class="modifyCustomerLink" href="updateUser.php"> Modify Customer Information</a></div>
<div class="viewPaymentRecord"><a class="viewPaymentRecordLink" href="viewSubscriptionPlanHistory.php"> Review the Payment Record </a></div>
<div class="showClickingTable"><a class="showClickingTableLink" href="showClickingTable.php"> Review the Chicking History </a></div>
</div>
<?php require('footer.php');?>
</body>
</html>