<?php

$mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');
$contract_id = $_COOKIE['abonent'];
$service_id = (int)($_GET['id']);

$mysql->query("DELETE FROM `Extra` WHERE `Extra`.`service_id` = $service_id AND `Extra`.`contract_id` = $contract_id;");

$mysql->close();
header('Location: ../User/LKservice.php');

 ?>
