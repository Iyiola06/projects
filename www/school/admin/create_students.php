<?php
session_start();
include('../include/admin_auth.php');
include('../include/db.php');
include('../include/function.php');

if(isset($_POST['submit'])){
	$error = array();
	
	if(empty($_POST['fullname'])){
		$error['fullname'] = "Please Enter Name";
	}
	
	if(empty($_POST['age'])){
		$error['age'] = "Please Enter Age";
	}elseif(!is_numeric($_POST['age'])){
		$error['age'] = "Numeric Value Required";
	}
	
	if(empty($_POST['class'])){
		$error['class'] = "Please Enter Class";
	}
	
	if(empty($error)){
		
		createStudents($conn,$_POST);
		header("Location:create_students.php");
	}
	
	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Students</title>
</head>

<body>
<?php
include('../include/admin_header.php');

?>
<form action="" method="post">
<?php
if(isset($error['fullname'])){
	echo "<p style='color:red'>".$error['fullname']."</p>";
}
?>
<p>FullName:<input type="text" name="fullname" /></p>
<?php
if(isset($error['age'])){
	echo "<p style='color:red'>".$error['age']."</p>";
}
?>

<p>Age:<input type="text" name="age" /></p>
<?php
if(isset($error['class'])){
	echo "<p style='color:red'>".$error['class']."</p>";
}
?>

<p>Class:<input type="text" name="class" ></p>
<?php
$statement = $conn->prepare("SELECT * FROM department");
$statement->execute();
echo"<p>";
echo"Departments:";
echo "<select name='department'>";
while($row = $statement->fetch(PDO::FETCH_BOTH)){
	echo"<option value='".$row['department_name']."'>".$row['department_name']."</option>";
}
echo"</select>";
echo"</p>";
?>
<?php
$statement = $conn->prepare("SELECT * FROM courses");
$statement->execute();
echo"Courses:";
echo "<select name='courses'>";
while($row = $statement->fetch(PDO::FETCH_BOTH)){
	echo"<option value='".$row['course_name']."'>".$row['course_name']."</option>";
}
echo"</select>";
?>
<br />

<input type="submit" name="submit" value="Submit" />
</form>


</body>
</html>