<?php
session_start();
include('../include/admin_auth.php');
include('../include/db.php');

if(isset($_GET['id'])){
	$students_id = $_GET['id'];
}
else{
	header("Location:manage_students.php");
}


$stmt = $conn->prepare("SELECT * FROM students WHERE students_id=:sid");
$stmt->bindParam(":sid",$students_id);
$stmt->execute();

$record = $stmt->fetch(PDO::FETCH_BOTH);
if($stmt->rowCount() < 1){
	header("Location:manage_students.php");
}

if(isset($_POST['submit'])){
$error = array();	
	
	if(empty($_POST['fullname'])){
		$error['fullname'] = "Please Enter Fullname";
	}
	
	if(empty($_POST['age'])){
		$error['age'] = "Please Enter Age";
	}
	
	if(empty($_POST['class'])){
		$error['class'] = "Please Enter Class";
	}
	
	if(empty($error)){
		$statement = $conn->prepare("UPDATE students SET students_name=:sn,students_age=:sa,students_class=:sc,students_department=:sd,course=:cs WHERE students_id=:sid");
		$data = array(
			":sn"=>$_POST['fullname'],
			":sa"=>$_POST['age'],
			":sc"=>$_POST['class'],
			":sd"=>$_POST['department'],
			":cs"=>$_POST['course'],
			":sid"=>$students_id['id']
		);
		
		$statement->execute($data);
		
		header("Location:manage_students.php");
		
	}
	
	
}




?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="" method="post">
<input type="text" name="fullname" value="<?=$record['students_name']?>" /><br />
<input type="text" name="age" value="<?=$record['students_age']?>" /><br />

<input type="text" name="class" value="<?=$record['students_class']?>" /><br />

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
echo "<select name='course'>";
while($row = $statement->fetch(PDO::FETCH_BOTH)){
	echo"<option value='".$row['course_name']."'>".$row['course_name']."</option>";
}
echo"</select>";
?>


<input type="submit" name="submit" value="UPDATE" />
</form>
</body>
</html>