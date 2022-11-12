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

    <title>Подключение тарифного плана
    </title>
  </head>
  <body>
    <div class="wrapper">
      <?php require "../blocks/header.php";
        $mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');
      ?>
      <?php
        $deal_id = $_GET['id'];
        $contract_id = $_COOKIE['abonent'];
        $result = $mysql->query("SELECT * FROM `Deal` WHERE `id` = '$deal_id'");
        $result = $result->fetch_assoc();
      ?>

      <section class="deal-confirm">

          <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold">Подключить тариф "<?= $result['deal_name']; ?>"?</h1>
            <div class="col-lg-6 mx-auto">
              <p class="lead mb-4">Абонентская плата за тариф «<?= $result['deal_name']; ?>» — <?= $result['price']; ?> ₽ в месяц с учетом включенных услуг. Неиспользованные остатки трафика и минут будут перенесены.</p>
              <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="button" class="square_btn" style="margin-right: 10px" onclick="location.href='../pages/deal.php?id=<?= $result['id']; ?>'">Информация о тарифе</button>
                <?php
                $account = $mysql->query("SELECT * FROM `Account` WHERE `contract_id` = '$contract_id'");
                $account = $account->fetch_assoc();
                $id_c = (int)($account['contract_id']);
                $contract = $mysql->query("SELECT * FROM `Contract` WHERE `id` = $id_c;");
                $contract = $contract->fetch_assoc();
                $balance = (float)$account['balance'];
                $deal_price = (float)$result['price'];
                if ($contract['deal_id'] == $deal_id){?>
                  <p style="text-align: center; margin-top: 5px;">Тариф уже подключен</p>
                <?php }
                else if (($balance - $deal_price) >= 0){?>
                  <button type="button" class="square_btn" onclick="location.href='../validation-form/DealConfirm.php?id=<?= $result['id']; ?>'">Подключить</button>
                <?php } else {?>
                  <p style="text-align: center; margin-top: 5px;">Для подключения тарифа недостаточно средств на счете</p>
                <?php } ?>
              </div>
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
