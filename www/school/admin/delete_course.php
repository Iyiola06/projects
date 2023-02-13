<?php
//include('../include/admin_auth.php');
include('../include/db.php');

if(!isset($_GET['id'])){
	header("Location:manage_courses.php");
	exit();
}

$statement = $conn->prepare("DELETE FROM courses WHERE course_id=:cid");
$statement->bindParam(":cid",$_GET['id']);
$statement->execute();

header("Location:manage_courses.php");
exit();