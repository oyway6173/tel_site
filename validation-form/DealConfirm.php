<?php

$mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');
mysqli_set_charset($mysql, "utf8");

$deal_id = (int)($_GET['id']);
$contract_id = (int)($_COOKIE['abonent']);
$result = $mysql->query("SELECT * FROM `Deal` WHERE `id` = '$deal_id';");
$result = $result->fetch_assoc();
$account = $mysql->query("SELECT * FROM `Account` WHERE `contract_id` = '$contract_id';");
$account = $account->fetch_assoc();
$balance = (double)$account['balance'];
$deal_price = (double)$result['price'];
$balance = (double)($balance - $deal_price);

$minutes = (int)$result['minutes'];
$sms = (int)$result['sms'];
$data = (double)$result['data'];

$transaction = $deal_price * (-1.00);
$account_id = (int)($account['id']);
if($result['unlimited'] == 'true'){
  $mysql->query("UPDATE `Account` SET `balance` = $balance, `unlimited` = 'true', `minutes` = 0, `sms` = 0, `data` = 0.00 WHERE `Account`.`id` = $account_id;");
  print $contract_id;
  $mysql->query("UPDATE `Contract` SET `deal_id` = '$deal_id' WHERE `Contract`.`id` = '$contract_id';");
  $mysql->query("INSERT INTO `Transaction` (`account_id`, `value`, `date`, `descr`) values ('$account_id', '$transaction', CURRENT_DATE(), 'deal');");
} else {

  $minutes = $minutes + (int)$account['minutes'];;
  $sms = $sms + (int)$account['sms'];
  $data = $data + (double)$account['data'];

  $mysql->query("UPDATE `Account` SET `balance` = $balance, `unlimited` = 'false', `minutes` = $minutes, `sms` = $sms, `data` = $data WHERE `Account`.`id` = $account_id;");
  print $contract_id;
  $mysql->query("UPDATE `Contract` SET `deal_id` = '$deal_id' WHERE `Contract`.`id` = '$contract_id';");
  $mysql->query("INSERT INTO `Transaction` (`account_id`, `value`, `date`, `descr`) values ('$account_id', '$transaction', CURRENT_DATE(), 'deal');");
}




//

$mysql->close();
header('Location: ../index.php');
?>
