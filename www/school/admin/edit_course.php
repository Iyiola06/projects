<?php
session_start();
include('../include/admin_auth.php');
include('../include/db.php');

if(isset($_GET['id'])){
	$course_id = $_GET['id'];
}else{
	header("Location:manage_courses.php");
}

$stmt = $conn->prepare("SELECT * FROM courses WHERE course_id=:cid");
$stmt->bindParam(":cid",$course_id);
$stmt->execute();

$record = $stmt->fetch(PDO::FETCH_BOTH);
if($stmt->rowCount() < 1){
	header("Location:manage_courses.php");
}

if(isset($_POST['submit'])){
$error = array();	
	
	if(empty($_POST['course_name'])){
		$error['course_name'] = "Please Enter Course Name";
	}
	
	if(empty($error)){
		$statement = $conn->prepare("UPDATE courses SET course_name=:cn WHERE course_id=:cid");
		$statement->bindParam(":cn",$_POST['course_name']);
		$statement->bindParam(":cid",$course_id);
		$statement->execute();
		
		header("Location:manage_courses.php");
		
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
<input type="text" name="course_name" value="<?=$record['course_name']?>" /><br />
<input type="submit" name="submit" value="UPDATE" />
</form>


</body>
</html>