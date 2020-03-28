<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP CURD Operation using PDO Extension  </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<h3>Insert Record | PHP CRUD Operations using PDO Extension</h3>
<hr />
</div>
</div>
<form name="insertrecord" method="post">
<div class="row">
<div class="col-md-4"><b>First Name</b>
<input type="text" name="firstname" class="form-control" required>
</div>
<div class="col-md-4"><b>Last Name</b>
<input type="text" name="lastname" class="form-control" required>
</div>
</div>
<div class="row">
<div class="col-md-4"><b>Email id</b>
<input type="email" name="emailid" class="form-control" required>
</div>
<div class="col-md-4"><b>Contactno</b>
<input type="text" name="contactno" class="form-control" maxlength="10" required>
</div>
</div>
<div class="row">
<div class="col-md-8"><b>Address</b>
<textarea class="form-control" name="address" required></textarea>
</div>
</div>
<div class="row" style="margin-top:1%">
<div class="col-md-8">
<input type="submit" name="insert" value="Submit">
</div>
</div>
</form>
</div>
</div>
</body>
</html>

<?php
// include database connection file
require_once'dbconfig.php';
if(isset($_POST['insert']))
{
// Posted Values
$fname=$_POST['firstname'];
$lname=$_POST['lastname'];
$emailid=$_POST['emailid'];
$contactno=$_POST['contactno'];
$address=$_POST['address'];
// Query for Insertion
$sql="INSERT INTO tblusers(FirstName,LastName,EmailId,ContactNumber,Address) VALUES(:firstname,:lastname,:email,:cno,:adrss)";
//Prepare Query for Execution
$query = $dbh->prepare($sql);
// Bind the parameters
$query->bindParam(':firstname',$fname,PDO::PARAM_STR);
$query->bindParam(':lastname',$lname,PDO::PARAM_STR);
$query->bindParam(':email',$emailid,PDO::PARAM_STR);
$query->bindParam(':cno',$contactno,PDO::PARAM_STR);
$query->bindParam(':adrss',$address,PDO::PARAM_STR);
// Query Execution
$query->execute();
// Check that the insertion really worked. If the last inserted id is greater than zero, the insertion worked.
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
// Message for successfull insertion
echo "<script>alert('Record inserted successfully');</script>";
echo "<script>window.location.href='index.php'</script>";
}
else
{
// Message for unsuccessfull insertion
echo "<script>alert('Something went wrong. Please try again');</script>";
echo "<script>window.location.href='index.php'</script>";
}
}
?>