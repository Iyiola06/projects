<?php
session_start();
include('../include/admin_auth.php');
include('../include/db.php');

if(isset($_GET['id'])){
	$department_id = $_GET['id'];
}
else{
	header("Location:manage_department.php");
}

$stmt = $conn->prepare("SELECT * FROM department WHERE department_id=:did");
$stmt->bindParam(":did",$department_id);
$stmt->execute();

$record = $stmt->fetch(PDO::FETCH_BOTH);
if($stmt->rowCount() < 1){
	header("Location:manage_department.php");
}


if(isset($_POST['submit'])){
$error = array();
	if(empty($_POST['department'])){
		$error = "Please Enter Department";
	}
	
	if(empty($error)){
		$statement=$conn->prepare("UPDATE department SET department_name=:dn WHERE department_id=:did");
		$statement->bindParam(":dn",$_POST['department']);
		$statement->bindParam(":did",$department_id);
		$statement->execute();
		
		header("Location:manage_department.php");
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
<input type="text" name="department" value="<?=$record['department_name']?>" />
<input type="submit" name="submit" value="UPDATE" />
</form>
</body>
</html>