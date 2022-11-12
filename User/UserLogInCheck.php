<?php
session_start();
$_SESSION['errorMessage'] = false;
$u_number = filter_var(trim($_POST['u-number']), FILTER_SANITIZE_STRING);
$u_pass = filter_var(trim($_POST['u-pass']), FILTER_SANITIZE_STRING);
$u_number = preg_replace('~^\+7~', '', $u_number);
$u_number = str_replace(array('(', ')', '-', ' '), '', $u_number);
$u_pass = md5($u_pass."telcom");

$mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');

$result = $mysql->query("SELECT * FROM `Contract` WHERE `number` = '$u_number'");
$user = $result->fetch_assoc();
$contract_id = $user['id'];
if(count($user) == 0){
  $_SESSION['errorNumber'] = true;
  header("Location: ../User/UserLogInForm.php");
  exit();
}

$result = $mysql->query("SELECT * FROM `Account` WHERE `contract_id` = '$contract_id' AND `password` = '$u_pass'");
$account = $result->fetch_assoc();
if(count($account) == 0){
  $_SESSION['errorPassword'] = true;
  header("Location: ../User/UserLogInForm.php");
  exit();
}

setcookie('abonent', $contract_id, time() + 7200, "/");


$mysql->close();

header('Location: ../index.php');

?>
