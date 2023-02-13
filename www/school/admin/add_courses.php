<?php
session_start();
include('../include/admin_auth.php');
include('../include/db.php');
include('../include/function.php');

if(isset($_POST['submit'])){
$error = array();
	
	if(empty($_POST['courses'])){
		$error['courses'] = "Please Enter Courses";
	}
	
	if(empty($error)){
		$stmt = $conn->prepare("INSERT INTO courses VALUES(NULL,:cn,:cb,NOW(),NOW() )");
	}
	$stmt->bindParam(":cn",$_POST['courses']);
	$stmt->bindParam(":cb",$_SESSION['admin_id']);
	$stmt->execute();
	
	header("Location:add_courses.php");
	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include('../include/admin_header.php');
?>
<form action="" method="post">
<input type="text" name="courses" placeholder="Add Course" />
<input type="submit" name="submit" value="CREATE" />

<table border="2">
<tr>
	<th>Course Name</th>
    <th>Created By</th>
    <th>Date Created</th>
    <th>Time Created</th>
</tr>

<?php
	$select = $conn->prepare("SELECT * FROM courses");
	$select->execute();
while($row = $select->fetch(PDO::FETCH_BOTH)){
	echo"<tr>";
	
	echo"<td>".$row['course_name']."</td>";
	echo"<td>".$row['created_by']."</td>";
	echo"<td>".$row['date_created']."</td>";
	echo"<td>".$row['time_created']."</td>";
	echo"</tr>";
}
?>

</table>
</form>
</body>
</html>