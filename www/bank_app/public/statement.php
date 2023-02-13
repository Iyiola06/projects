<?php
session_start();
include('../include/user_auth.php');
include('../include/db.php');
include('../include/user_info.php');

$statement = $conn->prepare("SELECT * FROM transactions WHERE senders_account=:ac OR receivers_account =:ac");
$statement->bindParam(":ac",$current_users_data['account_number']);
$statement->execute();
$statement_record = array();
while($row = $statement->fetch(PDO::FETCH_BOTH)){
	$statement_record[] = $row;
}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Account Statement</title>
</head>

<body>
<?php include('../include/user_header.php');?>

<table border="2">
<tr>
	<th>Senders Account</th>
    <th>Receivers Account</th>
    <th>Trabsaction Amount</th>
    <th>Previous Amount</th>
    <th>Final Balance</th>
    <th>Transaction Type</th>
    <th>Date</th>
    <th>Time</th>
</tr>

</table>



</body>
</html>