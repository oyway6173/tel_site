<?php
session_start();

$id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
$name = filter_var(trim($_POST['lastName'].' '.$_POST['firstName'].' '.$_POST['middleName']), FILTER_SANITIZE_STRING);
$ser = filter_var(trim($_POST['ser']), FILTER_SANITIZE_STRING);
$pnum = filter_var(trim($_POST['pnum']), FILTER_SANITIZE_STRING);
$dateofb = filter_var(trim($_POST['year'].'-'.$_POST['month'].'-'.$_POST['day']), FILTER_SANITIZE_STRING);
$address = filter_var(trim($_POST['address']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);

require_once '../config/connect.php';

$check_passport = $mysql->query("SELECT * FROM `User` WHERE `passport_ser` = '$ser' AND `passport_num` = '$pnum'");
$passport = mysqli_fetch_all($check_passport);


if(sizeof($passport) > 1){
  $_SESSION['wrongPassport'] = true;
  header("Location: ../Employee/UpdateUser.php?id=$id");
  exit();
}

if(mb_strlen($email) > 0){
  $check_email = $mysql->query("SELECT * FROM `User` WHERE `email` = '$email'");
  $email_check = mysqli_fetch_all($check_email);
  if(sizeof($email_check) > 1){
    $_SESSION['wrongEmail'] = true;
    header("Location: ../Employee/UpdateUser.php?id=$id");
    exit();
  }
  else {
      $mysql->query("UPDATE `User` SET `fio` = '$name', `passport_ser` = '$ser', `passport_num` = '$pnum', `date_of_birth` = '$dateofb', `address` = '$address', `email` = '$email' WHERE `User`.`id` = '$id'");
  }
}
else{
    $mysql->query("UPDATE `User` SET `fio` = '$name', `passport_ser` = '$ser', `passport_num` = '$pnum', `date_of_birth` = '$dateofb', `address` = '$address' WHERE `User`.`id` = '$id'");
}

$mysql->close();
header('Location: ../Employee/ListOfUsers.php');
?>
