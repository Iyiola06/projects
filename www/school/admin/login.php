<?php
session_start();
include('../include/db.php');

if(isset($_POST['submit'])){
$error = array();

if(empty($_POST['username'])){
	$error['username'] = "Please Enter Username";
}

if(empty($_POST['hash'])){
	$error['hash'] = "Please Enter Password";
}

if(empty($error)){
	$statement = $conn->prepare("SELECT *FROM admin WHERE admin_username = :us");
	$statement->bindParam(":us",$_POST['username']);
	$statement->execute();
	$record = $statement->fetch(PDO::FETCH_BOTH);

	if($statement->rowCount() > 0 && password_verify($_POST['hash'], $record['admin_hash'])){
		$_SESSION['admin_id'] = $record['admin_id'];
		$_SESSION['admin_username'] = $record['admin_username'];

		header("Location:dashboard.php");
	}


}else{
	header("Location:login.php?error=Either Email Or Password Incorrect");
}


}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Login</title>

<link rel="stylesheet" href="../styles/style.css">

</head>

<body>
<h1 style="text-align:center">TRIUMPH MODEL COLLEGE</h1>
<h2>ADMIN LOGIN</h2>
<?php
if(isset($_GET['error'])){
	echo $_GET['error'];
}

?>
<form action="" method="post" class="form">
	<div class="pass">
<?php
if(isset($error['username'])){
	echo $error['username'];
}
?>
<p> <input type="text" name="username" placeholder="Username" /></p>
<?php
if(isset($error['hash'])){
	echo $error['hash'];
}
?>
<p> <input type="password" name="hash" placeholder="Password" /></p>
	</div>
<input type="submit" name="submit" value="Login" class="submit"/> <p >Click <a href="signup.php">here</a> To Get Registered</p>

</form>


</body>
</html>
