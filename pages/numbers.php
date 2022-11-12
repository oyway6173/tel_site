<!DOCTYPE html>
<html lang="ru-RU">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE = edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <link rel="stylesheet" type="text/css" href="/css/boot.css">
    <link rel="stylesheet" type="text/css" href="/fonts/fonts.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script src="../js/tableSearch.js"></script>
    <title>Номера</title>
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
        $deal_id = $result['deal_id'];
        $deal = $mysql->query("SELECT * FROM `Deal` WHERE `id` = '$deal_id';");
        $deal = $deal->fetch_assoc();
      ?>
      <div class="container">

        <h1 class="deals-group-name">Выберите номер телефона</h1>

          <input class="form-control" type="text" placeholder="Введите один из параметров для поиска" id="search-text" onkeyup="tableSearch()">
          <section class="">
              <div class="table-responsive">
              <table class="table table-striped table-sm" id="table_info">
                <thead>
                  <tr>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $numbers = $mysql->query("SELECT * FROM `Number` where `occupied` = 'false'");
                    $numbers = mysqli_fetch_all($numbers);
                    foreach ($numbers as $number) {
                  ?>

                  <tr>
                    <td><?= $number[1]; ?></td>
                    <td align=center><a class="table-action" style="color: black" href="../Employee/UpdateUser.php?id=<?= $number[0]; ?>">Оставить заявку</a></td>
                  </tr>
                  <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </section>



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
    <?php require "../blocks/footer.php";
    $mysql->close();?>
    <script type="text/javascript">
      function test() {if (confirm("Необходимо войти в личный кабинет"))
    	{ window.open ('../User/UserLogInForm.php','_self',false)} }
    </script>

  </body>
</html>
