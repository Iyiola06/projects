<?php
session_start();
include('../include/admin_auth.php');
include('../include/db.php');
include('../include/function.php');

if(isset($_POST['submit'])){
$error = array();
	
	if(empty($_POST['department'])){
		$error['department'] = "Enter Department";
	}
	
	if(empty($error)){
	addDepartments($conn,$_POST);
		
		header("Location:add_departments.php");
	}
}



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Departments</title>
</head>

<body>
<?php
include('../include/admin_header.php');
?>
<form action="" method="post">
<input type="text" name="department" placeholder="Add Departments" />
<input type="submit" name="submit" value="CREATE" />
</form>

<table border="2">
<tr>	
	
	<th>Department Name</th>
    <th>Created By</th>
    <th>Date Created</th>
	<th>Time Created</th>

<?php
	$select = $conn->prepare("SELECT * FROM department");
	$select->execute();
while($row = $select->fetch(PDO::FETCH_BOTH)){
	echo"<tr>";
	
	echo"<td>".$row['department_name']."</td>";
	echo"<td>".$row['created_by']."</td>";
	echo"<td>".$row['date_created']."</td>";
	echo"<td>".$row['time_created']."</td>";
	echo"</tr>";
}
?>


</table>

</body>
</html>