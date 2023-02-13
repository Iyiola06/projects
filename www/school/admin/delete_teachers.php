<?php
include('../include/admin_auth.php');
include('../include/db.php');

if(!isset($_GET['id'])){
	header("Location:manage_teachers.php");
	exit();
}

$statement = $conn->prepare("DELETE FROM teachers WHERE teachers_id=:tid");
$statement->bindParam(":tid",$_GET['id']);
$statement->execute();

header("Location:manage_teachers.php");
exit();
