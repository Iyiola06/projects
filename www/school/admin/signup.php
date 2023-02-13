<?php

include'../include/db.php';

if(isset($_POST['submit'])){
$error = array();

if(empty($_POST['name'])){
	$error['name'] = "Please Enter Name";
}

if(empty($_POST['username'])){
	$error['username'] = "Please Enter Username";
}

if(empty($_POST['hash'])){
	$error['hash'] = "Please Enter Password";
}

if(empty($_POST['confirm_hash'])){
	$error['confirm_hash'] = "Please Confirm Password";
}elseif($_POST['hash'] !== $_POST['confirm_hash']){
	$error['confirm_hash'] = "Password Mismatch";
}

if(empty($error)){

	$encrypted = password_hash($_POST['hash'],PASSWORD_BCRYPT);
	$statement = $conn->prepare("INSERT INTO admin VALUES (NULL,:nm,:us,:hsh,NOW(),NOW() )");
	$data = array(
		":nm" =>$_POST['name'],
		":us" =>$_POST['username'],
		":hsh" =>$encrypted,
	);
	$statement->execute($data);
	header("Location:login.php");
	exit();


}else{

}

}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Signup Page</title>

<link rel="stylesheet" href="../styles/style.css">

</head>

<body >

<div class="container">

	<div class="left">
		<form class="form" method="post">

				<div class="header">
				
					<?php
						if (isset($_GET['confirm_hash'])) {
							echo $_GET['confirm_hash'];
						}
					 ?>
					 <?php
						 if (isset($_GET['name'])) {
							 echo $_GET['name'];
						 }
						?>
						<?php
							if (isset($_GET['username'])) {
								echo $_GET['username'];
							}
						 ?>

						<?php
							if (isset($_GET['hash'])) {
								echo $_GET['hash'];
							}
						 ?>

					<h1 class="align" style="font-family:arial">Triumph Model College</h1>
					<h2 class="align">Create Admin Account</h1>

				</div>
			<input class="input" type="text" name="name" placeholder="Full Name">
			<input class="input" type="text" name="username" placeholder="Username">
			<input class="input" type="password" name="hash" placeholder="Password">

			<input class="input" type="password" name="confirm_hash" placeholder="Confirm Password">

			<input  class="submit" type="submit" name="submit" value="Sign Up">

		</form>
	</div>

	<div class="right">
		<div class="space">

		</div>
			<div class="sign">
				<h1 class="">Already Registered </h1>
				<p class="">login to access your account</p>
				<a href="login.php"><input class="sign_in"  type="button" value="Sign In"></a>

			</div>
	</div>
<div class="space">

</div>
</div>

</body>
</html>
