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
    <title>Информация о тарифе
    </title>
  </head>
  <body>
    <div class="wrapper">
      <?php require "../blocks/header.php";
        $mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');
      ?>
      <?php
        $deal_id = $_GET['id'];
        $result = $mysql->query("SELECT * FROM `Deal` WHERE `id` = '$deal_id'");
        $result = $result->fetch_assoc();
      ?>
      <section class="deal-view">
        <div class="container">
          <div class="deal-info"><span class="deal-title"><?= $result['deal_name']; ?></span>
            <div class="deal-about"><span class="deal-message__descr"><?= $result['deal_descr']; ?></span></div>
            <div class="deal-descr"><img class="deal-descr__img" src="https://img.icons8.com/android/24/000000/infinity.png"><span class="deal-descr__text-1">безлимит</span><span class="deal-descr__text-2"> на номера нашей сети в России</span></div>
            <?php if($result['unlimited'] == 'true') {?>
              <div class="deal-minutes"><img class="deal-minutes__img" src="https://img.icons8.com/android/24/000000/phone.png"><span class="deal-minutes__value">безлимит</span><span class="deal-minutes__descr"> минут на остальные номера России</span></div>
              <div class="deal-internet"><img class="deal-internet__img" src="https://img.icons8.com/pastel-glyph/24/000000/internet.png"><span class="deal-internet__value">безлимит</span><span class="deal-internet__descr"> гигабайт трафика</span></div>
            <?php } else {?>
              <div class="deal-minutes"><img class="deal-minutes__img" src="https://img.icons8.com/android/24/000000/phone.png"><span class="deal-minutes__value"><?= $result['minutes']; ?></span><span class="deal-minutes__descr"> минут на остальные номера России</span></div>
              <div class="deal-internet"><img class="deal-internet__img" src="https://img.icons8.com/pastel-glyph/24/000000/internet.png"><span class="deal-internet__value"><?= $str = substr($result['data'],0,-3); ?></span><span class="deal-internet__descr"> гигабайт трафика</span></div>
            <?php } ?>
            <div class="deal-message"><img class="deal-message__img" src="https://img.icons8.com/fluent-systems-filled/24/000000/messaging-.png"><span class="deal-message__descr">Безлимитные соцсети и мессенджеры</span><img class="deal-message__socials-img" src="../img/general/socials.png"></div>
            <div class="deal-buy">
              <div class="deal-buy__price">
                <div class="deal-buy__price-value__wrap">
                  <div class="deal-buy__price-value"><?= $str = substr($result['price'],0,-3); ?></div>
                  <div class="deal-buy__price-currency">₽</div>
                </div>
                <div class="deal-buy__price-descr">в месяц</div>
              </div>
              <div class="deal-buy__buttons">
                <?php
                  if($_COOKIE['abonent'] == ''):
                ?>
                <input class="g-btn-buy" type="button" value="Подключить" onclick="test()">
                <input class="g-btn-buy-sim" type="button" value="Купить SIM" onclick="location.href='index.html'">
                <?php else: ?>
                <input class="g-btn-buy" type="button" value="Подключить" onclick="location.href='../User/UserDeal.php?id=<?= $result['id']; ?>'">
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="deal-params">
        <div class="container"><span class="deal-params__title">В абонентскую плату входит</span>
          <div class="deal-params__internet">
            <div class="deal-params__internet-title"><img class="deal-param__internet-title__img" src="https://img.icons8.com/pastel-glyph/30/000000/internet.png"><span class="deal-params__internet-title__text">Интернет</span></div>
            <div class="deal-params__internet-traffic">
              <div class="deal-params__internet-traffic__descr">пакет интернета</div>
              <?php if($result['unlimited'] == 'true') {?>
                <div class="deal-params__internet-traffic__value">безлимит</div>
              <?php } else {?>
                <div class="deal-params__internet-traffic__value"><?= $str = substr($result['data'],0,-3); ?> ГБ</div>
              <?php } ?>
            </div>
            <div class="deal-params__internet-socials">бесплатный трафик в <?= $result['socials']; ?></div>
            <div class="deal-params__internet-info">данные условия действительны на территории РФ</div>
          </div>
          <div class="deal-params__calls">
            <div class="deal-params__calls-title"><img class="deal-params__calls-title__img" src="https://img.icons8.com/android/30/000000/phone-disconnected.png"><span class="deal-params__calls-title__descr">Звонки</span></div>
            <div class="deal-params__calls-unlimit">безлимитные звонки в нашей сети на территории РФ</div>
            <div class="deal-params__calls-other">
              <div class="deal-params__calls-other__descr">звонки на номера других операторов</div>
              <?php if($result['unlimited'] == 'true') {?>
                <div class="deal-params__internet-traffic__value">безлимит</div>
              <?php } else {?>
                <div class="deal-params__calls-other__value"><?= $result['minutes']; ?> минут</div>
              <?php } ?>
            </div>
            <div class="deal-params__calls-info">данные условия действительны на территории РФ</div>
          </div>
          <div class="deal-params__calls">
            <div class="deal-params__calls-title"><img class="deal-params__calls-title__img" src="https://img.icons8.com/material-outlined/30/000000/sms.png"><span class="deal-params__calls-title__descr">СМС</span></div>
            <div class="deal-params__calls-unlimit">безлимитные смс в нашей сети на территории РФ</div>
            <div class="deal-params__calls-other">
              <div class="deal-params__calls-other__descr">смс на номера других операторов</div>
              <?php if($result['unlimited'] == 'true') {?>
                <div class="deal-params__calls-other__value">безлимит</div>
              <?php } else {?>
                <div class="deal-params__calls-other__value"><?= $result['sms']; ?> шт.</div>
              <?php } ?>
            </div>
            <div class="deal-params__calls-info">данные условия действительны на территории РФ</div>
          </div>
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
    <?php require "../blocks/footer.php" ?>
    <script type="text/javascript">
      function test() {if (confirm("Необходимо войти в личный кабинет"))
    	{ window.open ('../User/UserLogInForm.php','_self',false)} }
    </script>
  </body>
</html>
