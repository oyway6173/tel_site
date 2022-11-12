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
    <title>ЛК Услуги
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
        // $deal_id = $result['deal_id'];
        // $deal = $mysql->query("SELECT * FROM `Deal` WHERE `id` = '$deal_id';");
        // $deal = $deal->fetch_assoc();

      ?>
      <div class="container">
        <div class="pricing-header p-3 pb-md-3 mx-auto text-left">
          <h1 class="display-5 fw-normal">Услуги</h1>
        </div>
        <h1 class="display-6 fw-normal text-center mb-3">Активные услуги</h1>


        <div class="my-3 p-3 bg-body rounded shadow-sm">
          <h6 class="border-bottom pb-2 mb-0">Услуги</h6>

          <?php
          $res = $mysql->query("SELECT count(*) FROM `Extra` where `contract_id` = '$contract_id'");
          $row = $res->fetch_row();
          $count = $row[0];
          if($count == 0){?>
            <p class="fs-5 text-muted">У вас нет подключенных услуг</p>
          <?php } else {
          $services = $mysql->query("SELECT * FROM `Extra` where `contract_id` = '$contract_id'");
          $services = mysqli_fetch_all($services);
          foreach ($services as $service) {
           ?>
          <div class="d-flex text-muted pt-3">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="../img/content/products/product5.png" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#b00d23"></rect><text x="50%" y="50%" fill="#b00d23" dy=".3em"></text></svg>

            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
              <div class="d-flex justify-content-between">
                <?php
                $service_name = $mysql->query("SELECT * FROM `Service` WHERE `id` = '$service[1]';");
                $service_name = $service_name->fetch_assoc(); ?>
                <strong class="text-gray-dark" style="font-size: 1.143rem;"><?= $service_name['service_name'] ?></strong>
                <a href="../validation-form/ServiceDisable.php?id=<?= $service[1]; ?>" style="color: #b00d23;">Отключить</a>
              </div>
              <span class="d-block"><?= $service_name['service_price'] ?> ₽/день</span>
            </div>
          </div>
        <?php } ?>
          <small class="d-block text-end mt-3">
            <a href="../validation-form/AllServiceDisable.php">Отключить все</a>
          </small>
        <?php } ?>
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
