<?php
include('../include/admin_auth.php');
include('../include/db.php');

if(!isset($_GET['id'])){
	header("Location:manage_department.php");
	exit();
}

$statement = $conn->prepare("DELETE FROM department WHERE department_id=:did");
$statement->bindParam(":did",$_GET['id']);
$statement->execute();

header("Location:manage_department.php");
exit();