<!DOCTYPE html>
<html lang="ru-RU">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE = edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <link rel="stylesheet" type="text/css" href="../fonts/fonts.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Главная страница
    </title>
  </head>
  <body>
    <div class="wrapper">

      <?php require "blocks/header.php";
        $mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');
      ?>

      <section class="index-slider">
        <div class="container">
          <div class="js-index-slider__pager"><a href="" data-slide-index="0"></a><a href="" data-slide-index="1"></a><a href="" data-slide-index="2"></a></div>
        </div>
        <ul class="js-index-slider">
          <li>
            <?php
              $result = $mysql->query("SELECT * FROM `Deal` WHERE `id` = '2'");
              $result = $result->fetch_assoc();
            ?>
            <img src="img/content/mainslider/slider1.jpg">
            <div class="index-slider__info"><span class="index-slider__title">Говори бесконечно</span><span class="index-slider__goods">При любом балансе на тарифах #<?= $result['deal_name']; ?></span><span class="index-slider__descr"><?= $result['deal_descr']; ?></span>
              <div class="index-slider__action"><span class="index-slider__price">Стоимость: <?= $result['price']; ?> р./мес</span><span class="index-slider__buy">Подробнее</span></div>
            </div>
          </li>
          <li>
            <?php
              $result = $mysql->query("SELECT * FROM `Deal` WHERE `id` = '1'");
              $result = $result->fetch_assoc();
            ?>
            <img src="img/content/mainslider/slider2.jpg">
            <div class="index-slider__info"><span class="index-slider__title">Будь всегда на связи</span><span class="index-slider__goods">С тарифом #<?= $result['deal_name']; ?></span><span class="index-slider__descr"><?= $result['deal_descr']; ?></span>
              <div class="index-slider__action"><span class="index-slider__price">Стоимость: <?= $result['price']; ?> р./мес</span><span class="index-slider__buy" onclick="location='https://jsfiddle.net/'">Подключить</span></div>
            </div>
          </li>
          <li>
            <img src="img/content/mainslider/slider3.jpg">
            <?php
              $result = $mysql->query("SELECT * FROM `Deal` WHERE `id` = '3'");
              $result = $result->fetch_assoc();
            ?>
            <div class="index-slider__info"><span class="index-slider__title">Еще больше трафика</span><span class="index-slider__goods">С тарифом #<?= $result['deal_name']; ?></span><span class="index-slider__descr"><?= $result['deal_descr']; ?></span>
              <div class="index-slider__action"><span class="index-slider__price">Стоимость: <?= $result['price']; ?> р./мес</span><span class="index-slider__buy">Подключить</span></div>
            </div>
          </li>
        </ul>
      </section>
      <section class="new-arrivals">
        <div class="container">
          <div class="section-title">
            <div class="section-title__big"><span class="section-title__orange">Выбери</span><span> Тариф</span></div><span class="section-title__descr">Скидка 10% на абонентскую плату при подключении тарифов серии Стандарт</span>
          </div>
          <div class="product-item__wrap clearfix">

          <?php for ($i = 1; $i <= 5; $i++) {?>

            <div class="deal-item">
              <div class="deal-item__first">
                <?php
                  $result = $mysql->query("SELECT * FROM `Deal` WHERE `id` = '$i'");
                  $result = $result->fetch_assoc();
                ?>
                <span class="deal-item__title"><?= $result['deal_name']; ?></span><span class="deal-item__title-descr"><?= $result['deal_descr']; ?></span>
                <?php if($result['minutes'] == 0){?>
                  <div class="deal-item__minutes"><span class="deal-item__minutes-value">∞</span><span class="deal-item__minutes-descr">минут</span></div>
                <?php } else { ?>
                  <div class="deal-item__minutes"><span class="deal-item__minutes-value"><?= $result['minutes']; ?></span><span class="deal-item__minutes-descr">минут</span></div>
                <?php } ?>

                <?php if($result['data'] == 0){?>
                  <div class="deal-item__gb"><span class="deal-item__gb-value">∞</span><span class="deal-item__gb-descr">ГБ</span></div>
                <?php } else { ?>
                  <div class="deal-item__gb"><span class="deal-item__gb-value"><?= $result['data']; ?></span><span class="deal-item__gb-descr">ГБ</span></div>
                <?php } ?>


                <?php
                  $myvalue = $result['socials'];;
                  $arr = explode(', ',trim($myvalue));
                 ?>
                <span class="deal-item__messenger-telegram"></span><span class="deal-item__messenger-descr"><?= $arr[0]; ?> и еще 3 бесплатных мессенджера</span><span class="deal-item__social-insta"></span>
                <span class="deal-item__social-descr"><?= $arr[1]; ?> и еще 3 бесплатных соцсети</span><span class="deal-item__price-num"><?= $result['price']; ?> р.</span><span class="deal-item__price-descr">в месяц</span>
                <div class="deal-item__buy">
                  <input class="g-btn" type="button" value="Подробнее" onclick="location.href='../pages/deal.php?id=<?= $result['id']; ?>?>'">
                </div>
              </div>
            </div>

          <?php } ?>

        </div><a class="product-item__more-load" href="../pages/deals.php">...</a>
        </div>
      </section>
      <section class="banners">
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
      <section class="best-sales">
        <div class="container clearfix">
          <div class="section-title">
            <div class="section-title__big"><span class="section-title__orange">Лучшие</span><span> Услуги</span></div><span class="section-title__descr">Услуги мобильной связи</span>
          </div>
          <div class="best-sales__item-wrap">

            <?php for ($i = 1; $i <= 3; $i++) {?>

              <?php
                $result = $mysql->query("SELECT * FROM `Service` WHERE `id` = '$i'");
                $result = $result->fetch_assoc();
              ?>
              <div class="best-sales__item"><img class="best-sales__img" src="../img/content/products/product5.png">
                <div class="best-sales__info"><span class="best-sale__title"><?= $result['service_name']; ?></span>
                  <div class="best-sales__rating"><span class="best-sales__price">Ежедневная плата: <?= $result['service_price']; ?> р.</span></div><a class="best-sales__buy" href="javascript:void:(0);">Подключить</a>
                </div>
              </div>
            <?php } ?>

          </div>
          <a class="product-item__more-load" href="../pages/services.php">...</a>
        </div>
      </section>
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

    <?php require "blocks/footer.php" ?>

    <script src="js/jquery.js"></script>
    <script src="js/libs.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript">
      function test() {if (confirm("Необходимо войти в личный кабинет"))
    	{ window.open ('../User/UserLogInForm.php','_self',false)} }
    </script>
  </body>
</html>
