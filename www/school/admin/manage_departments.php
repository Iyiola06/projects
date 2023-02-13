<?php
session_start();
include('../include/admin_auth.php');
include('../include/db.php');

$fetch = $conn->prepare("SELECT * FROM departments");
$fetch->execute();

$records = array();

while($row=$fetch->fetch(PDO::FETCH_BOTH)){
	$records[]=$row;
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php include('../include/admin_header.php')?>

<table border="2">
<tr>
	<th>Department_id</th>
    <th>Department_name</th>
</tr>
<tr>
	<?php foreach($records as $value):?>
    <td><?=$value['department_id']?></td>
    <td><?=$value['department_name']?></td>
    
    <?php endforeach?>
</tr>

</body>
</html>