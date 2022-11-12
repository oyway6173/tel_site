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

    <title>Услуги
    </title>
  </head>
  <body>
    <div class="wrapper">
      <?php require "../blocks/header.php";
      $mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');
      ?>

      <div class="container">
          <h1 class="deals-group-name">Услуги мобильной связи</h1>
      </div>
      <div class="album py-5 bg-light">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php
        $res = $mysql->query("SELECT count(*) FROM `Service`");
        $row = $res->fetch_row();
        $count = $row[0];
        for ($i = 1; $i <= $count; $i++) {
          $result = $mysql->query("SELECT * FROM `Service` WHERE `id` = '$i'");
          $result = $result->fetch_assoc();
          ?>
        <div class="col" style="display: contents;">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#d4d4d4"></rect><text x="35%" y="50%" fill="#34404b" dy=".3em"></text></svg>

            <div class="card-body">
              <p style="font-size: 1.543rem;"><?= $result['service_name']; ?></p>
              <p class="card-text"><?= $result['service_descr']; ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.href='../pages/service.php?id=<?= $result['id']; ?>'">Подробнее</button>
                  <?php
                    if($_COOKIE['abonent'] == ''):
                  ?>
                  <button type="button" class="btn btn-sm btn-outline-secondary" onclick="test()">Подключить</button>
                  <?php else: ?>
                  <button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.href='../User/UserService.php?id=<?= $result['id']; ?>'">Подключить</button>
                  <?php endif; ?>
                </div>
                <small class="text-muted"><?= $result['service_price']; ?> ₽/день</small>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>



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
