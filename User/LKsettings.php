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
    <title>ЛК Настройки
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
          <div class="row g-5 py-5">
            <div class="feature col-md-4">
              <div class="feature-icon bg-primary bg-gradient" style="background-color: #b00d23!important; display: inline-flex; align-items: center;justify-content: center;width: 4rem;height: 4rem; margin-bottom: 0.5rem; margin-top: 1rem; font-size: 2rem; color: #fff; border-radius: .75rem; ">
                <!-- <svg class="bi" width="1em" height="1em"><use xlink:href="../img/general/user.png"></use></svg> -->
              <img src="https://img.icons8.com/wired/45/000000/change.png" style="margin-left: 2px;">
              </div>
              <h2>Смена номера</h2>
              <p style="font-size: 1.143rem">Выберите новый номер с сохранением текущего тарифа и подключенных новых услуг</p>
              <a href="#" class="icon-link" onClick="change()">Вперед</a>
            </div>
            <div class="feature col-md-4">
              <div class="feature-icon bg-primary bg-gradient" style="background-color: #b00d23!important; display: inline-flex; align-items: center;justify-content: center;width: 4rem;height: 4rem; margin-bottom: 0.5rem; margin-top: 1rem; font-size: 2rem; color: #fff; border-radius: .75rem; ">
                <!-- <svg class="bi" width="1em" height="1em"><use xlink:href="../img/general/user.png"></use></svg> -->
              <img src="https://img.icons8.com/android/40/000000/cancel-2.png" style="margin-left: 1px;">
              </div>
              <h2>Блокировка</h2>
              <p style="font-size: 1.143rem">Если вы потеряли телефон или у вас его украли</p>
              <a class="icon-link" onClick="block()">Заблокировать</a>
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
      function change() {if (confirm("К сожалению, смена номера недоступна. Пожалуйста, обратитесь за услугой в ближайший салон связи."))
    	{ window.open ('../User/LKsettings.php','_self',false)} }
      function block() {if (confirm("К сожалению, блокировка номера недоступна. Пожалуйста, обратитесь за услугой в ближайший салон связи."))
    	{ window.open ('../User/LKsettings.php','_self',false)} }
    </script>
  </body>
</html>
