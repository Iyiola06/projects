<?php
session_start();
include'../include/db.php';

if(isset($_POST['submit'])){
	$error = array();
	
	if(empty($_POST['email'])){
		$error['email'] = "Enter Email";
	}
	
	if(empty($_POST['hash'])){
		$error['hash']= "Enter Password";
	}
	
	if(empty($error)){
		$stmt = $conn->prepare("SELECT * FROM admin WHERE email=:em");
		$stmt->bindParam(":em",$_POST['email']);
		$stmt->execute(); 
		$record = $stmt->fetch(PDO::FETCH_BOTH);
		
		//echo "What user typed is".$_POST['hash']."<br>";
		//echo"The password in the database is ".$record['hash'];
		
		if($stmt->rowCount() > 0 && password_verify($_POST['hash'], $record['hash'])){
			
		$_SESSION['admin_id'] = $record['admin_id'];
		$_SESSION['admin_name'] = $record['name'];

		header("Location:dashboard.php");
			
	}else{
		header("Location:login.php?error=Either Email or Password incorrect");
	}
		
	}
	
}



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Page</title>
</head>

<body>
<?php
if(isset($_GET['error'])){
	echo $_GET['error'];
}
?>

<form action="" method="post">
<?php if(isset($error['email'])){
	echo $error['email'];
}
?>
<p> Email: <input type="email" name="email" /></p>


<?php if(isset($error['hash'])){
	echo $error['hash'];
}
?>


<p>Password: <input type="password" name="hash" /></p>
<input type="submit" name="submit" value="Login" />

</form>
</body>
</html>