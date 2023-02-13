<?php
session_start();
include('../include/db.php');
include('../include/user_auth.php');

include('../include/user_info.php')

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Dashboard</title>
</head>

<body>

<h2>Account Name: <?= $current_users_data['account_name']?></h2>
<h2>Account Number: <?= $current_users_data['account_number']?></h2>
<h2>Account Balance: <?= $current_users_data['account_balance']?></h2>
<hr />
<a href="transfer.php">Transfer</a>
<a href="account_statements.php">Account Statement</a>
<a href="logout.php">Logout</a>

</body>
</html>