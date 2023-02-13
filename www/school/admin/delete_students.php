<?php
include('../include/admin_auth.php');
include('../include/db.php');

if(!isset($_GET['id'])){
	header("Location:manage_students.php");
	exit();
}

$statement = $conn->prepare("DELETE FROM students WHERE students_id=:sid");
$statement->bindParam(":sid",$_GET['id']);
$statement->execute();

header("Location:manage_students.php");
exit();