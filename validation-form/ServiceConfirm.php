<?php

$mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');
mysqli_set_charset($mysql, "utf8");

$service_id = (int)($_GET['id']);
$contract_id = (int)($_COOKIE['abonent']);
$result = $mysql->query("SELECT * FROM `Service` WHERE `id` = '$service_id';");
$result = $result->fetch_assoc();
$account = $mysql->query("SELECT * FROM `Account` WHERE `contract_id` = '$contract_id';");
$account = $account->fetch_assoc();
$balance = (double)$account['balance'];
$service_price = (double)$result['service_price'];
$balance = (double)($balance - $service_price);
$account_id = (int)($account['id']);
$transaction = $service_price * (-1.00);
print $balance;
$mysql->query("UPDATE `Account` SET `balance` = $balance WHERE `Account`.`id` = $account_id;");
$mysql->query("INSERT INTO `Extra` (`service_id`, `contract_id`, `start_date`) VALUES ('$service_id', '$contract_id', CURRENT_DATE());");
$mysql->query("INSERT INTO `Transaction` (`account_id`, `value`, `date`, `descr`) values ('$account_id', '$transaction', CURRENT_DATE(), 'service');");
$mysql->close();
header('Location: ../index.php');
?>
