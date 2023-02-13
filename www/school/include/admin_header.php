<?php
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<h5>Admin id:<?=$_SESSION['admin_id']?></h5>
<h5>Admin name:<?=$_SESSION['admin_username']?></h5>
<hr />
<h1 style="text-align:center">TRIUMPH MODEL COLLEGE</h1>
<a href="dashboard.php">Dashboard</a>
<a href="create_teachers.php">Create Teachers</a>
<a href="create_students.php">Create Students</a>
<a href="add_departments.php">Add Departments</a>
<a href="add_courses.php">Add Courses</a>
<a href="manage_teachers.php">Manage Teachers</a>
<a href="manage_students.php">Manage Students</a>
<a href="manage_department.php">Manage Department</a>
<a href="manage_courses.php">Manage Courses</a>
<a href="logout.php">Logout</a>
</body>
</html>