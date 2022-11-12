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
    <title>Информация об услуге
    </title>
  </head>
  <body>
    <div class="wrapper">
      <?php require "../blocks/header.php";
        $mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');
      ?>
      <?php
        $service_id = $_GET['id'];
        $result = $mysql->query("SELECT * FROM `Service` WHERE `id` = '$service_id'");
        $result = $result->fetch_assoc();
      ?>
      <section class="deal-view">
        <div class="container">
          <div class="deal-info"><span class="deal-title"><?= $result['service_name']; ?></span>
            <div class="deal-about"><span class="deal-message__descr"><?= $result['service_descr']; ?></span></div>
            <div class="deal-buy">
              <div class="deal-buy__price">
                <div class="deal-buy__price-value__wrap">
                  <div class="deal-buy__price-value"><?= $str = substr($result['service_price'],0,-3); ?></div>
                  <div class="deal-buy__price-currency">₽</div>
                </div>
                <div class="deal-buy__price-descr">в месяц</div>
              </div>
              <div class="deal-buy__buttons">
                <?php
                  if($_COOKIE['abonent'] == ''):
                ?>
                <input class="g-btn-buy" type="button" value="Подключить" onclick="test()">
                <input class="g-btn-buy-sim" type="button" value="Купить SIM" onclick="location.href='#'">
                <?php else: ?>
                <input class="g-btn-buy" type="button" value="Подключить" onclick="location.href='../User/UserService.php?id=<?= $result['id']; ?>'">
                <?php endif; ?>
              </div>
            </div>
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
