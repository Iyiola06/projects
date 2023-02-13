<?php
session_start();
include('../include/admin_auth.php');
include('../include/db.php');

$fetch=$conn->prepare("SELECT * FROM teachers");

$fetch->execute();

$records=array();

while($row=$fetch->fetch(PDO::FETCH_BOTH)){
	$records[]=$row;
}


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Teachers</title>
</head>

<body>

<?php include('../include/admin_header.php');?>
<table border="2">
<tr>
	<th>Full Name</th>
    <th>Age</th>
    <th>Qualification</th>
    <th>Subject</th>
    <th>Date Created</th>
    <th>Time Created</th>
</tr>
<?php foreach($records as $value):?>
<tr>
    <td><?= $value['teachers_name']?></td>
    <td><?=$value['teachers_age']?></td>
    <td><?=$value['qualification']?></td>
    <td><?=$value['subject']?></td>
   <td><?=$value['date_created']?></td>
    <td><?=$value['time_created']?></td>
 </tr>   
<?php endforeach?>

</table>



</body>
</html>