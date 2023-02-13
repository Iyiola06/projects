<?php
session_start();

include'../include/authenticate.php';
include'../include/db.php';

$fetch=$conn->prepare("SELECT * FROM blog");
$fetch->execute();

$records=array();

while($row=$fetch->fetch(PDO::FETCH_BOTH)){
	$records[]=$row;
}

//var_dump($records)

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Blog</title>
</head>

<body>

<h2>Manage Blog</h2>

<?php include'../include/header.php'; ?>

<table border="2" >
<tr>
	<th>Title</th>
    <th>Author</th>
    <th>Category </th>
	<th>Body</th>
    <th>Edit</th>
    <th>Delete</th>
	<th>Date Published</th>
    <th>Time Published</th>
</tr>
<?php foreach($records as $value): ?>
<tr>
	<td><?=$value['title']?></td>
    <td><?=$value['author']?></td>
    <td><?=$value['category']?></td>
    <td><?=$value['body']?></td>
    <td><a href="edit_blog.php?id=<?=$value['blog_id']?>">Edit</a></td>
    <td><a href="delete_blog.php?id=<?=$value['blog_id']?>">Delete</a></td>
    <td><?=$value['date_created']?></td>
    <td><?=$value['time_created']?></td>
</tr>
<?php endforeach ?>

</table>






</body>
</html>