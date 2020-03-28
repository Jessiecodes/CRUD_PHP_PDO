<?php
// include database connection file
require_once'dbconfig.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP CRUD Operations using PDO Extension </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">

    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <style type="text/css">
    
        #container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #999;
            text-transform: uppercase;
            text-align: center;
        }
     th {
         text-align: center;
         color: darkslategray;
     }
       
    </style>

</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12"  id="container">
<h3 id="title">PHP CRUD Operations using PDO Extension</h3> <hr />
<a href="insert.php"><button class="btn btn-primary"> Insert Record</button></a>
<div class="table-responsive">
<table id="mytable" class="table table-bordred table-striped">
<thead>
<th>#</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>Contact</th>
<th>Address</th>
<th>Posting Date</th>
<th>Edit</th>
<th>Delete</th>
</thead>
<tbody>
<?php
$sql = "SELECT FirstName,LastName,EmailId,ContactNumber,Address,PostingDate,id from tblusers";
//Prepare the query:
$query = $dbh->prepare($sql);
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
<!-- Display Records -->
    <tr>
    <td><?php echo htmlentities($cnt);?></td>
    <td><?php echo htmlentities($result->FirstName);?></td>
    <td><?php echo htmlentities($result->LastName);?></td>
    <td><?php echo htmlentities($result->EmailId);?></td>
    <td><?php echo htmlentities($result->ContactNumber);?></td>
    <td><?php echo htmlentities($result->Address);?></td>
    <td><?php echo htmlentities($result->PostingDate);?></td>
<td><a href="update.php?id=<?php echo htmlentities($result->id);?>"><button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></button></a></td>
<td><a href="index.php?del=<?php echo htmlentities($result->id);?>"><button class="btn btn-danger btn-xs" onClick="return confirm('Do you really want to delete');"><span class="glyphicon glyphicon-trash"></span></button></a></td>
    </tr>
<?php
// for serial number increment
$cnt++;
}} ?>

</tbody>
</table>
</div>
</div>
</div>
</div>
</body>
</html>
<?php

// Code for record deletion
if(isset($_REQUEST['del']))
{
//Get row id
$uid=intval($_GET['del']);
//Qyery for deletion
$sql = "delete from tblusers WHERE  id=:id";
// Prepare query for execution
$query = $dbh->prepare($sql);
// bind the parameters
$query-> bindParam(':id',$uid, PDO::PARAM_STR);
// Query Execution
$query -> execute();
// Mesage after updation
echo "<script>alert('Record Updated successfully');</script>";
// Code for redirection
echo "<script>window.location.href='index.php'</script>";
}
?>