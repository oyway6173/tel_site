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
    <title>Тарифы
    </title>
  </head>
  <body>
    <div class="wrapper">

      <?php require "../blocks/header.php";
        $mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');
      ?>
      <section class="all-deals">
        <div class="container">
          <div class="deals-detailed-list">
            <h1 class="deals-group-name">Тарифы для смартфонов</h1>

            <?php
            $res = $mysql->query("SELECT count(*) FROM `Deal`");
            $row = $res->fetch_row();
            $count = $row[0];
            for ($i = 1; $i <= $count; $i++) {?>
              <?php
                $result = $mysql->query("SELECT * FROM `Deal` WHERE `id` = '$i'");
                $result = $result->fetch_assoc();
              ?>
              <div class="deal-card">
                <h1 class="deal-card__title"><?= $result['deal_name']; ?>
                  <input class="g-btn-underline" type="text" value="Подробнее" onclick="location.href='../pages/deal.php?id=<?= $result['id']; ?>'">
                </h1>
                <div class="deal-card__param">
                  <div class="deal-cards__info">
                    <div class="deal-cards__info-first">безлимит</div>
                    <div class="deal-cards__info-second">в нашей сети на территории России</div>
                  </div>

                  <div class="deal-card__param-minutes">
                    <?php if($result['minutes'] == 0){?>
                      <div class="deal-card__param-minutes__value">∞</div>
                      <div class="deal-card__param-minutes__descr">безлимит на остальные номера России</div>
                    <?php } else { ?>
                      <div class="deal-card__param-minutes__value"><?= $result['minutes']; ?></div>
                      <div class="deal-card__param-minutes__descr">минут на остальные номера России</div>
                    <?php } ?>
                  </div>
                  <div class="deal-card__param-internet">
                    <?php if($result['minutes'] == 0){?>
                      <div class="deal-card__param-internet__value">∞</div>
                      <div class="deal-card__param-internet__descr">безлимитный трафик</div>
                    <?php } else { ?>
                      <div class="deal-card__param-internet__value"><?= $str = substr($result['data'],0,-3); ?></div>
                      <div class="deal-card__param-internet__descr">ГБ</div>
                    <?php } ?>
                  </div>
                  <div class="deal-card__param-mess">
                    <?php if($result['minutes'] == 0){?>
                      <div class="deal-card__param-mess__value">∞</div>
                      <div class="deal-card__param-mess__descr">безлимитный пакет SMS</div>
                    <?php } else { ?>
                      <div class="deal-card__param-mess__value"><?= $result['sms']; ?></div>
                      <div class="deal-card__param-mess__descr">SMS</div>
                    <?php } ?>
                  </div>
                </div>
                <?php
                  $myvalue = $result['socials'];;
                  $arr = explode(', ',trim($myvalue));
                 ?>
                <div class="deal-card__social">
                  <div class="deal-card__social-telegram">
                    <div class="deal-card__social-telegram-logo"><img src="https://img.icons8.com/plumpy/24/000000/telegram-app.png"></div>
                    <div class="deal-card__social-telegram-descr">Telegram и еще три бесплатных мессенджера</div>
                  </div>
                  <div class="deal-card__social-instagram">
                    <div class="deal-card__social-instagram-logo"><img src="https://img.icons8.com/material-outlined/24/000000/instagram-new--v1.png"></div>
                    <div class="deal-card__social-instagram-descr"><?= $arr[0]; ?> и три безлимитные соцсети</div>
                  </div>
                  <div class="deal-card__social-movie">
                    <div class="deal-card__social-movie-logo"><img src="https://img.icons8.com/fluent-systems-filled/24/000000/film-reel.png"></div>
                    <div class="deal-card__social-movie-descr">Более 500000 фильмов и сериалов на сервисе Link!</div>
                  </div>
                </div>
                <div class="deal-card__buy">
                  <div class="deal-card__buy-price">
                    <div class="deal-card__buy-price-value__wrap">
                      <div class="deal-card__buy-price-value"><?= $str = substr($result['price'],0,-3);; ?></div>
                      <div class="deal-card__buy-price-currency">₽</div>
                    </div>
                    <div class="deal-card__buy-price-descr">в месяц</div>
                  </div>
                  <div class="deal-card__btns">
                    <?php
                      if($_COOKIE['abonent'] == ''):
                    ?>
                    <input class="g-btn" type="button" value="Выбрать" onclick="test()">
                    <input class="g-btn-underline" type="text" value="Купить SIM" onclick="location.href='index.html'">
                    <?php else: ?>
                    <input class="g-btn" type="button" value="Выбрать" onclick="location.href='../User/UserDeal.php?id=<?= $result['id']; ?>'">
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php  }?>


      <section class="subscribe">
        <div class="container">
          <div class="subscribe__content"><span class="subscribe__title">Подпишись</span><span class="subscribe__descr">Получай новости и специальные предложения</span>
            <form class="subscribe-form">
              <div class="input-field__wrap">
                <input class="input-field" type="text" name="mail" placeholder="введите свой email">
                <input class="g-btn" type="submit" value="Подписаться">
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>

    <?php require "../blocks/footer.php" ?>

    <script src="static/js/jquery.js"></script>
    <script src="static/js/libs.min.js"></script>
    <script src="static/js/main.js"></script>
    <script type="text/javascript">
      function test() {if (confirm("Необходимо войти в личный кабинет"))
    	{ window.open ('../User/UserLogInForm.php','_self',false)} }
    </script>
  </body>
</html>
