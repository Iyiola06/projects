<?php
session_start();
include'../include/db.php';

$blog = $conn->prepare("SELECT * FROM blog WHERE category=:cid");
$blog -> bindParam(":cid",$_GET['category_id']);
$blog -> execute();
$blog_record = array();

while($row = $blog->fetch(PDO::FETCH_BOTH)){
	$blog_record[] = $row;
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="style.css" />
<title>Blog Category</title>
</head>

<body id="body" >
<?php include'../include/user_header.php';?>
<?php foreach($blog_record as $value):?>
<a href="view_blog.php?id=<?=$value['blog_id']?>"><h3><?= $value['title'] ?> by <?= $value['author']?></h3></a>
<?php endforeach;?>
</body>
</html>