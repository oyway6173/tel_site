<?php
session_start();
$_SESSION['errorMessage'] = false;
$e_login = filter_var(trim($_POST['e-login']), FILTER_SANITIZE_STRING);
$e_pass = filter_var(trim($_POST['e-pass']), FILTER_SANITIZE_STRING);

$e_pass = md5($e_pass."mynewproj");

$mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');

$result = $mysql->query("SELECT * FROM `Employee` WHERE `e_login` = '$e_login' AND `e_pass` = '$e_pass'");
$user = $result->fetch_assoc();


if(count($user) == 0){
  $_SESSION['errorMessage'] = true;
  header("Location: /Employee/EmployeeLogInForm.php");
  exit();
}

setcookie('empl', $user['id'], time() + 3600, "/");


$mysql->close();

header('Location: /Employee/EmployeeLogInForm.php');

?>
