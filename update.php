<?php
// include database connection file
require_once'dbconfig.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP CURD Operation using PDO Extension  </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<style>
#update_form {
   padding: 50px;


}
</style>
</head>



<?php

if(isset($_POST['update']))
{
// Get the userid
$userid=intval($_GET['id']);
// Posted Values
$fname=$_POST['firstname'];
$lname=$_POST['lastname'];
$emailid=$_POST['emailid'];
$contactno=$_POST['contactno'];
$address=$_POST['address'];
// Query for Updation
$sql="update tblusers set FirstName=:fn,LastName=:ln,EmailId=:eml,ContactNumber=:cno,Address=:adrss where id=:uid";
//Prepare Query for Execution
$query = $dbh->prepare($sql);
// Bind the parameters
$query->bindParam(':fn',$fname,PDO::PARAM_STR);
$query->bindParam(':ln',$lname,PDO::PARAM_STR);
$query->bindParam(':eml',$emailid,PDO::PARAM_STR);
$query->bindParam(':cno',$contactno,PDO::PARAM_STR);
$query->bindParam(':adrss',$address,PDO::PARAM_STR);
$query->bindParam(':uid',$userid,PDO::PARAM_STR);
// Query Execution
$query->execute();
// Mesage after updation
echo "<script>alert('Record Updated successfully');</script>";
// Code for redirection
echo "<script>window.location.href='index.php'</script>";
}
?>
<?php
// Get the userid
$userid=intval($_GET['id']);
$sql = "SELECT FirstName,LastName,EmailId,ContactNumber,Address,PostingDate,id from tblusers where id=:uid";
//Prepare the query:
$query = $dbh->prepare($sql);
//Bind the parameters
$query->bindParam(':uid',$userid,PDO::PARAM_STR);
//Execute the query:
$query->execute();
//Assign the data which you pulled from the database (in the preceding step) to a variable.
$results=$query->fetchAll(PDO::FETCH_OBJ);
// For serial number initialization
$cnt=1;
if($query->rowCount() > 0)
{
//In case that the query returned at least one record, we can echo the records within a foreach loop:
foreach($results as $result)
{
?>
<form name="insertrecord" method="post" id="update_form">
<div class="row">
    <a class="btn btn-warning" href="index.php"> Go back </a>
<h3 class="update_title"> Update the customer record below.</h3>

<div class="col-md-4"><b>First Name</b>
<input type="text" name="firstname" value="<?php echo htmlentities($result->FirstName);?>" class="form-control" required>
</div>
<div class="col-md-4"><b>Last Name</b>
<input type="text" name="lastname" value="<?php echo htmlentities($result->LastName);?>" class="form-control" required>
</div>
</div>
<div class="row">
<div class="col-md-4"><b>Email id</b>
<input type="email" name="emailid" value="<?php echo htmlentities($result->EmailId);?>" class="form-control" required>
</div>
<div class="col-md-4"><b>Contactno</b>
<input type="text" name="contactno" value="<?php echo htmlentities($result->ContactNumber);?>" class="form-control" maxlength="10" required>
</div>
</div>
<div class="row">
<div class="col-md-8"><b>Address</b>
<textarea class="form-control" name="address" required><?php echo htmlentities($result->Address);?></textarea>
</div>
</div>
<?php }} ?>
<div class="row" style="margin-top:1%">
<div class="col-md-8">
<input type="submit" name="update" value="Update">
</div>
</div>
</form>