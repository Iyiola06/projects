<?php

$statement = $conn->prepare("SELECT * FROM customer WHERE customer_id = :cid");
$statement->bindParam(":cid",$_SESSION['id']);
$statement->execute();

if($statement->rowCount() < 1){
	header("Location:login.php?error=This record does not exist on our system");
	exit();
}

$current_users_data = $statement->fetch(PDO::FETCH_BOTH);

?>