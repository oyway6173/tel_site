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

    <title>Подключение услуги
    </title>
  </head>
  <body>
    <div class="wrapper">
      <?php require "../blocks/header.php";
        $mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');
      ?>
      <?php
        $service_id = $_GET['id'];
        $contract_id = $_COOKIE['abonent'];
        $result = $mysql->query("SELECT * FROM `Service` WHERE `id` = '$service_id'");
        $result = $result->fetch_assoc();
      ?>

      <section class="deal-confirm">

          <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold">Подключить услугу "<?= $result['service_name']; ?>"?</h1>
            <div class="col-lg-6 mx-auto">
              <p class="lead mb-4">Абонентская плата за услугу «<?= $result['service_name']; ?>» — <?= $result['service_price']; ?> ₽ в день.</p>
              <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="button" class="square_btn" style="margin-right: 10px" onclick="location.href='../pages/service.php?id=<?= $result['id']; ?>'">Информация об услуге</button>
                <?php
                $account = $mysql->query("SELECT * FROM `Account` WHERE `contract_id` = '$contract_id'");
                $account = $account->fetch_assoc();
                $id_c = (int)($account['contract_id']);
                $extra = $mysql->query("SELECT * FROM `Extra` WHERE `contract_id` = $id_c;");
                $extra = $extra->fetch_assoc();
                $kol = $mysql->query("SELECT count(*) FROM `Extra` WHERE `contract_id` = $id_c and `service_id` = $service_id;");
                $row = $kol->fetch_row();
                $kol = $row[0];
                $balance = (float)$account['balance'];
                $service_price = (float)$result['service_price'];
                if ($kol != 0){?>
                  <p style="text-align: center; margin-top: 5px;">Услуга уже подключена</p>
                <?php }
                else if (($balance - $service_price) >= 0){?>
                  <button type="button" class="square_btn" onclick="location.href='../validation-form/ServiceConfirm.php?id=<?= $result['id']; ?>'">Подключить</button>
                <?php } else {?>
                  <p style="text-align: center; margin-top: 5px;">Для подключения услуги недостаточно средств на счете</p>
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
