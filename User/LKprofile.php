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
    <title>ЛК Расходы
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
        $account_id = $account['id'];
        // $deal_id = $result['deal_id'];
        // $deal = $mysql->query("SELECT * FROM `Deal` WHERE `id` = '$deal_id';");
        // $deal = $deal->fetch_assoc();
        $res = $mysql->query("SELECT SUM(`value`) from Transaction where `value` < 0 and MONTH(`date`) = MONTH(NOW()) and `account_id` = '$account_id'");
        $row = $res->fetch_row();
        $sum = $row[0];
        $res = $mysql->query("SELECT SUM(`value`) from Transaction where `descr` = 'deal' and MONTH(`date`) = MONTH(NOW()) and `account_id` = '$account_id'");
        $row = $res->fetch_row();
        $round_deal = $row[0];
        $res = $mysql->query("SELECT SUM(`value`) from Transaction where `descr` = 'service' and MONTH(`date`) = MONTH(NOW()) and `account_id` = '$account_id'");
        $row = $res->fetch_row();
        $round_service = $row[0];
        $res = $mysql->query("SELECT SUM(`value`) from Transaction where `descr` = 'call' and MONTH(`date`) = MONTH(NOW()) and `account_id` = '$account_id'");
        $row = $res->fetch_row();
        $round_call = $row[0];

        $p_deal = round($round_deal / $sum * 100);
        $p_service = round($round_service / $sum * 100);
        $p_call = round($round_call / $sum * 100);
      ?>


      <div class="container">
        <div class="pricing-header p-3 pb-md-3 mx-auto text-left">
          <h1 class="display-5 fw-normal">Расходы</h1>
        </div>
        <div class="feature text-center" style="background: white;">
          <div class="feature-icon bg-primary bg-gradient" style="background-color: #b00d23!important; display: inline-flex; align-items: center;justify-content: center;width: 4rem;height: 4rem; margin-bottom: 0.5rem; margin-top: 1rem; font-size: 2rem; color: #fff; border-radius: .75rem; ">
            <!-- <svg class="bi" width="1em" height="1em"><use xlink:href="../img/general/user.png"></use></svg> -->
            <img src="https://img.icons8.com/small/45/ffffff/user-male-circle.png" style="margin-left: 3px;">
          </div>
          <h2><?= $user['fio']; ?></h2>
          <p style="font-size: 1.143rem"><?= $number ?></p>
          <p style="font-size: 1.143rem"><?= $user['email']; ?></p>
          <a href="Details.php" class="square_btn" style="margin-bottom: 20px;">Заказать детализацию</a>
          <!-- <a href="#" class="icon-link" onClick="prompt('Введите адрес электронной почты','пример@gmail.com')">Редактировать</a> -->
        </div>
        <div class="" style="background: white; margin-top: 30px;">
        <div class="pricing-header p-3 pb-md-3 mx-auto text-left">
          <h1 class="display-7 fw-normal">Ваши расходы за текущий месяц</h1>
        </div>
        <figure>
          <div class="figure-content">
            <svg width="100%" height="100%" viewBox="0 0 42 42" class="donut" aria-labelledby="beers-title beers-desc" role="img">
              <title id="beers-title">Beers in My Cellar</title>
              <desc id="beers-desc">Donut chart showing 10 total beers. Two beers are Imperial India Pale Ales, four beers are Belgian Quadrupels, and three are Russian Imperial Stouts. The last remaining beer is unlabeled.</desc>
              <circle class="donut-hole" cx="21" cy="21" r="15.91549430918954" fill="#fff" role="presentation"></circle>
              <circle class="donut-ring" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#d2d3d4" stroke-width="3" role="presentation"></circle>
              <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#ce4b99" stroke-width="3" stroke-dasharray="<?= $p_deal ?> <?= 100 - $p_deal ?>" stroke-dashoffset="25" aria-labelledby="donut-segment-1-title donut-segment-1-desc">
                <title id="donut-segment-1-title">Абонентская плата</title>
                <desc id="donut-segment-1-desc">Pink chart segment spanning 40% of the whole, which is 4 Belgian Quadrupels out of 10 total.</desc>
              </circle>
              <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#b1c94e" stroke-width="3" stroke-dasharray="<?= $p_service ?> <?= 100 - $p_service ?>" stroke-dashoffset="<?= 100 - $p_deal + 25 ?>">
                <title id="donut-segment-2-title">Услуги</title>
                <desc id="donut-segment-2-desc">Green chart segment spanning 20% of the whole, which is 2 Imperial India Pale Ales out of 10 total.</desc>
              </circle>
              <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#377bbc" stroke-width="3" stroke-dasharray="<?= $p_call ?> <?= 100 - $p_call ?>" stroke-dashoffset="<?= 100 - ($p_deal + $p_service) + 25 ?>">
                <title id="donut-segment-3-title">Звонки</title>
                <desc id="donut-segment-3-desc">Blue chart segment spanning 3% of the whole, which is 3 Russian Imperial Stouts out of 10 total.</desc>
              </circle>
              <!-- unused 10% -->
              <g class="chart-text">
                <text x="50%" y="50%" class="chart-number">
                  <?= abs($sum); ?>
                </text>
                <text x="50%" y="50%" class="chart-label">
                  Руб.
                </text>
              </g>
            </svg>
          </div>
          <figcaption class="figure-key">
            <p class="sr-only">Donut chart showing 10 total beers. Two beers are Imperial India Pale Ales, four beers are Belgian Quadrupels, and three are Russian Imperial Stouts. The last remaining beer is unlabeled.</p>
            <ul class="figure-key-list" aria-hidden="true" role="presentation">
              <li>
                <span class="shape-circle shape-fuschia"></span> Абонентская плата (<?= abs($round_deal); ?>₽)
              </li>
              <li>
                <span class="shape-circle shape-lemon-lime"></span> Плата за услуги (<?= abs($round_service); ?>₽)
              </li>
              <li>
                <span class="shape-circle shape-blue"></span> Звонки (<?= abs($round_call); ?>₽)
              </li>
              <li>
                <span class="shape-circle shape-gray"></span> Прочее (<?= abs($sum) - abs($round_deal + $round_call + $round_service); ?>₽)
              </li>
            </ul>
          </figcaption>
        </figure>
        </div>
      </div>
      <section class="banners" style="margin-bottom: 10px; margin-top: 20px;">
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
