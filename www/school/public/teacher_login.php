<?php
session_start();
include('../include/db.php');

if(isset($_POST['submit'])){
$error = array();

if(empty($_POST['name'])){
	$error['name'] = "Please Enter Name";

}

if(empty($error)){
	$statement = $conn->prepare("SELECT *FROM teachers WHERE teachers_name = :nm");
	$statement->bindParam(":nm",$_POST['name']);
	$statement->execute();
	$record = $statement->fetch(PDO::FETCH_BOTH);

	if($statement->rowCount() > 0){
		$_SESSION['teachers_id'] = $record['teachers_id'];
		$_SESSION['teachers_name'] = $record['teachers_name'];

		header("Location:teacher.php");
	}


}else{
	header("Location:teacher_login.php?error=Wrong or No Name");
}


}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teachers Login</title>
</head>

<body>
<h1 style="text-align:center">TRIUMPH MODEL COLLEGE</h1>
<?php
if(isset($_GET['error'])){
	echo $_GET['error'];
}

?>
<form action="" method="post">
<?php
if(isset($error['Name'])){
	echo $error['Name'];
}
?>
<p>Name: <input type="text" name="name" /></p>

<input type="submit" name="submit" value="Login" />

</form>

</body>
</html>
