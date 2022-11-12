<?php
  session_start();


  $name = filter_var(trim($_POST['lastName'].' '.$_POST['firstName'].' '.$_POST['middleName']), FILTER_SANITIZE_STRING);
  $ser = filter_var(trim($_POST['ser']), FILTER_SANITIZE_STRING);
  $pnum = filter_var(trim($_POST['pnum']), FILTER_SANITIZE_STRING);
  $dateofb = filter_var(trim($_POST['year'].'-'.$_POST['month'].'-'.$_POST['day']), FILTER_SANITIZE_STRING);
  $address = filter_var(trim($_POST['address']), FILTER_SANITIZE_STRING);
  $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
  $number = filter_var(trim($_POST['number']), FILTER_SANITIZE_STRING);
  $deal_name = filter_var(trim($_POST['deal']), FILTER_SANITIZE_STRING);
  print_r($_POST);

  // if(mb_strlen($login) < 5 || mb_strlen($login) > 25){
  //   echo "Недопустимая длина логина";
  //   exit();
  // } else if(mb_strlen($name) < 3 || mb_strlen($name) > 50){
  //   echo "Недопустимая длина имени";
  //   exit();
  // } else if(mb_strlen($pass) < 2 || mb_strlen($pass) > 6){
  //   echo "Недопустимая длина пароля (от двух до шестти символов)";
  //   exit();
  // }

  //$pass = md5($pass."mynewproj");
  //print_r($_POST);
  $mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');
  mysqli_set_charset($mysql, "utf8");

  $check_passport = $mysql->query("SELECT * FROM `User` WHERE `passport_ser` = '$ser' AND `passport_num` = '$pnum'");
  $passport = $check_passport->fetch_assoc();

  if(count($passport) != 0){
    $_SESSION['wrongPassport'] = true;
    header("Location: ../Employee/AddNewUser.php");
    exit();
  }



  if(mb_strlen($email) > 0){
    $check_email = $mysql->query("SELECT * FROM `User` WHERE `email` = '$email'");
    $email_check = $check_email->fetch_assoc();
    if(count($email_check) != 0){
      $_SESSION['wrongEmail'] = true;
      header("Location: ../Employee/AddNewUser.php");
      exit();
    }
    else {
        $mysql->query("INSERT INTO `User` (`fio`, `passport_ser`, `passport_num`, `date_of_birth`, `address`, `email`) VALUES('$name', '$ser', '$pnum', '$dateofb', '$address', '$email')");
    }
  }
  else{
      $mysql->query("INSERT INTO `User` (`fio`, `passport_ser`, `passport_num`, `date_of_birth`, `address`) VALUES('$name', '$ser', '$pnum', '$dateofb', '$address')");
  }

  $user_id = $mysql->query("SELECT `id` FROM `User` WHERE `passport_ser` = '$ser' AND `passport_num` = '$pnum'");
  $user_id = $user_id->fetch_assoc();
  $user_id = $user_id['id'];
  print_r($user_id);

  $deal = $mysql->query("SELECT * FROM `Deal` WHERE `deal_name` = '$deal_name'");
  $deal= $deal->fetch_assoc();
  $deal_id = $deal['id'];
  $deal_min = $deal['minutes'];
  $deal_data = $deal['data'];
  $deal_sms = $deal['sms'];
  $empl_id = $_COOKIE['empl'];
  print_r($deal_min);
  print_r($deal_data);
  print_r($deal_sms);


  $mysql->query("INSERT INTO `Contract` (`date`, `number`, `deal_id`, `user_id`, `employee_id`, `state`) VALUES (CURRENT_DATE, '$number', '$deal_id', '$user_id', '$empl_id', 'active');");

  $mysql->query("UPDATE `Number` SET `occupied` = 'true' WHERE `Number`.`number` = '$number';");

  $contract_id = $mysql->query("SELECT `id` FROM `Contract` WHERE `number` = '$number'");
  $contract_id = $contract_id->fetch_assoc();
  $contract_id = $contract_id['id'];
  print_r($contract_id);
  $mysql->query("INSERT INTO `Account` (`contract_id`, `minutes`, `data`, `sms`) VALUES ('$contract_id', '$deal_min', '$deal_data', '$deal_sms');");

  $mysql->close();

  header('Location: ../Employee/AddNewUser.php');

?>
