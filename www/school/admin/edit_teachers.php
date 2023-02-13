<?php
session_start();
include('../include/admin_auth.php');
include('../include/db.php');


if(isset($_GET['id'])){
	$teachers_id = $_GET['id'];
}
else{
	header("Location:manage_teachers.php");
}


$statement = $conn->prepare("SELECT * FROM teachers WHERE teachers_id=:tid");
$statement->bindParam(":tid",$teachers_id);
$statement->execute();

$record = $statement->fetch(PDO::FETCH_BOTH);
if($statement->rowCount() < 1){
	header("Location:manage_teachers.php");
}


if(isset($_POST['submit'])){
$error = array();
	
 	if(empty($_POST['fullname'])){
		$error['fullname'] = "Please Enter Fullname";
	}
	
	if(empty($_POST['age'])){
		$error['age'] = "Please Enter Age";
	}elseif(!is_numeric($_POST['age'])){
		$error['age'] = "Numeric Value Required";
	}
	
	if(empty($_POST['qualification'])){
		$error['qualification'] = "Please Enter Qualification";
	}
	
	if(empty($_POST['department'])){
		$error['department'] = "Please Enter Department";
	}
	
	if(empty($_POST['course'])){
		$error['course'] = "Please Enter Course";
	}
	
	if(empty($_POST['subject'])){
		$error['subject'] = "Please Enter Subject";
	}
	
	if(empty($error)){
		$statement = $conn->prepare("UPDATE teachers SET teachers_name =:fnm,teachers_age=:age,qualification=:qn,departments=:dn,course=:cs,subject=:sb WHERE teachers_id=:tid");
		$statement->bindParam(":fnm",$_POST['fullname']);
		$statement->bindParam(":age",$_POST['age']);
		$statement->bindParam(":qn",$_POST['qualification']);
		$statement->bindParam(":dn",$_POST['department']);
		$statement->bindParam(":cs",$_POST['course']);
		$statement->bindParam(":sb",$_POST['subject']);
		$statement->bindParam(":tid",$teachers_id);
		
		$statement->execute();
		
		header("Location:manage_teachers.php");	
	}
	
}



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Teacher</title>
</head>

<body>
<form action="" method="post">
<p><input type="text" name="fullname" placeholder="Name" value="<?=$record['teachers_name']?>" /></p>
<p><input type="text" name="age" placeholder="Age" value="<?=$record['teachers_age']?>" /></p>
<p><input type="text" name="qualification" placeholder="Qualification" value="<?=$record['qualification']?>" /></p>
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

<p><input type="text" name="subject" placeholder="subject" value="<?=$record['subject']?>" /></p>
<input type="submit" name="submit" value="UPDATE" />
</form>


</body>
</html>