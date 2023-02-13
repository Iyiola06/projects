<?php
session_start();
include('../include/admin_auth.php');
include('../include/db.php');

$fetch = $conn->prepare("SELECT * FROM courses");
$fetch->execute();

$records = array();

while($row=$fetch->fetch(PDO::FETCH_BOTH)){
	$records[]=$row;
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Courses</title>
</head>

<body>
<?php include('../include/admin_header.php')?>


<table border="2">
<tr>
	<th>Course_id</th>
    <th>Course_name</th>
    <th>Edit</th>
    <th>Delete</th>
    <th>Date Created</th>
    <th>Time Created</th>

    
</tr>


	<?php foreach($records as $value):?>
    <tr>
    <td><?=$value['course_id']?></td>
    <td><?=$value['course_name']?></td>
      <td><a href="edit_course.php?id=<?=$value['course_id']?>">Edit</a></td>
    <td><a href="delete_course.php?id=<?=$value['course_id']?>">Delete</a></td>
    <td><?=$value['date_created']?></td>
    <td><?=$value['time_created']?></td>
    </tr>
    <?php endforeach?>

</table>


</body>
</html>