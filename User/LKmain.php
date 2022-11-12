<!DOCTYPE html>
<html lang="ru-RU">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE = edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <link rel="stylesheet" type="text/css" href="../fonts/fonts.css">
    <link rel="stylesheet" type="text/css" href="../css/boot.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>ЛК Обзор
    </title>
  </head>
  <body>
    <div class="wrapper">

      <?php require "../blocks/header.php";
        $mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');
        $contract_id = $_COOKIE['abonent'];
        $result = $mysql->query("SELECT * FROM `Contract` WHERE `id` = '$contract_id'");
        $result = $result->fetch_assoc();
        $number = $result['number'];
        $number = substr($number, 0, 3)." ".substr($number, 3, 3)." ".substr($number, 6, 2)." ".substr($number, 8, 2);
        $number = "+7 ".$number;
        $user_id = $result['user_id'];
        $user = $mysql->query("SELECT * FROM `User` WHERE `id` = '$user_id';");
        $user = $user->fetch_assoc();
        $account = $mysql->query("SELECT * FROM `Account` WHERE `contract_id` = '$contract_id';");
        $account = $account->fetch_assoc();
      ?>
      <div class="container">
        <div class="pricing-header p-3 pb-md-3 mx-auto text-left">
          <h1 class="display-5 fw-normal"><?= $number; ?></h1>
          <p class="fs-5 text-muted"><?= $user['fio']; ?></p>
        </div>
        <h1 class="display-6 fw-normal text-center mb-3">Остатки по тарифу</h1>
        <div class="col" style="display: -webkit-box;">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3" style=" border: solid 2px #b00d23; color: #b00d23;">
            <h4 class="my-0 fw-normal" style="text-align: center;">Связь</h4>
          </div>
          <div class="card-body" style="text-align: center;">
            <h1 class="card-title pricing-card-title"><?= $account['minutes']; ?><small class="text-muted fw-light"> минут</small></h1>
          </div>
        </div>
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3" style=" border: solid 2px #b00d23; color: #b00d23;">
            <h4 class="my-0 fw-normal" style="text-align: center;">Трафик</h4>
          </div>
          <div class="card-body" style="text-align: center;">
            <h1 class="card-title pricing-card-title"><?= $account['data']; ?><small class="text-muted fw-light"> ГБ</small></h1>
          </div>
        </div>
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3" style=" border: solid 2px #b00d23; color: #b00d23;">
            <h4 class="my-0 fw-normal" style="text-align: center;">СМС</h4>
          </div>
          <div class="card-body" style="text-align: center;">
            <h1 class="card-title pricing-card-title"><?= $account['sms']; ?><small class="text-muted fw-light"> шт.</small></h1>
          </div>
        </div>
      </div>
      <h1 class="display-6 fw-normal text-center mb-3">Платежный баланс</h1>
      <div class="col" style="display: -webkit-box; text-align: -webkit-center;">
      <div class="card mb-4 rounded-3 shadow-sm">
        <div class="card-header py-3" style=" border: solid 2px #b00d23; color: #b00d23;">
          <h4 class="my-0 fw-normal" style="text-align: center;">Баланс</h4>
        </div>
        <div class="card-body" style="text-align: center;">
          <h1 class="card-title pricing-card-title"><?= $account['balance']; ?><small class="text-muted fw-light"> ₽</small></h1>
        </div>
      </div>
      </div>

      </div>
      <section class="banners" style="margin-bottom: 10px;">
        <div class="container">
          <?php
            $result = $mysql->query("SELECT * FROM `Deal` WHERE `id` = '6'");
            $result = $result->fetch_assoc();
          ?>
          <div class="banner-big"><img class="banner-big__img" src="../img/content/banners/phone.png">
            <div class="banner-big__text"><span class="banner-big__title"><?= $result['deal_name']; ?></span><span class="banner-big__descr"><?= $result['deal_descr']; ?></span></div><a class="banner-big__price" href="javascript:void:(0);"><?= $result['price']; ?> р./мес</a>
          </div>
          <div class="banner-small">
            <div class="banner-empty__wrap"><span class="banner-empty__text">Здесь могла быть ваша</span><span class="banner-empty__text banner-empty__text--orange"> реклама</span><span class="banner-size">470 x 100</span></div>
          </div>
        </div>
      </section>
      <section class="subscribe">
      </section>
    </div>
    <?php require "../blocks/footer.php" ?>
    <script type="text/javascript">
      function test() {if (confirm("Необходимо войти в личный кабинет"))
    	{ window.open ('../User/UserLogInForm.php','_self',false)} }
    </script>
  </body>
</html>
