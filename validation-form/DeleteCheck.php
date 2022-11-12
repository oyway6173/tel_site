<?php
  require_once '../config/connect.php';

  $id = $_GET['id'];

  $mysql->query("DELETE FROM `User` WHERE `User`.`id` = '$id'");

  header('Location: ../Employee/ListOfUsers.php');

  $mysql->close();

?>
