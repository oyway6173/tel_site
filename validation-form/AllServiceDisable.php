<?php

$mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');
$contract_id = (int)($_COOKIE['abonent']);
$service_id = (int)($_GET['id']);
print $contract_id;
$mysql->query("DELETE FROM `Extra` WHERE `Extra`.`contract_id` = $contract_id;");

$mysql->close();
header('Location: ../User/LKservice.php');

 ?>
