<?php
session_start();
include'../include/db.php';

$blog = $conn->prepare("SELECT * FROM blog");
$blog->execute();
$records = array();

while($row = $blog->fetch(PDO::FETCH_BOTH)){
	$records[]=$row;
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body id="body">
<h1 class="h1">Welcome to Homepage</h1>
<div id="menu"><?php include'../include/user_header.php'?></div>

<?php foreach($records as $value): ?>

<a href="view_blog.php?id=<?=$value['blog_id']?>"><h3><?= $value['title'] ?> by <?= $value['author']?></h3></a>


<?php endforeach;?>
</body>
</html>