<?php
  header('Content-Type: text/html; charset=utf-8');
  mb_internal_encoding("UTF-8");
  $mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');
  $mysql->set_charset("utf8");
  mysqli_set_charset($mysql, 'utf8');
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <link rel="stylesheet" type="text/css" href="/css/boot.css">
    <link rel="stylesheet" type="text/css" href="/fonts/fonts.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script src="../js/tableSearch.js"></script>
    <title>Список договоров</title>
  </head>
  <body>
    <div class="wrapper">
      <?php require "../blocks/EmployeeHeader.php"; ?>
      <div class="limit">
        <div class="container">
          <div class="section-title__empl-big"><span class="section-title__red">Список</span><span> Абонентов</span></div>
          <input class="form-control" type="text" placeholder="Введите один из параметров для поиска" id="search-text" onkeyup="tableSearch()">
          <section class="">
              <div class="table-responsive">
              <table class="table table-striped table-sm" id="info-table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Дата заключения договора</th>
                    <th>Номер</th>
                    <th>Тариф</th>
                    <th>ID абонента</th>
                    <th>ID сотрудника</th>
                    <th>Состояние</th>
                    <th>Изменение</th>
                    <th>Расторжение</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $contracts = $mysql->query("SELECT * FROM `Contract`");
                    $contracts = mysqli_fetch_all($contracts);
                    foreach ($contracts as $contract) {
                  ?>

                  <tr>
                    <td><?= $contract[0]; ?></td>
                    <td><?= $contract[1]; ?></td>
                    <td><?= $contract[2]; ?></td>
                    <td><?php $deal = $mysql->query("SELECT `deal_name` FROM `Deal` WHERE `id` = $contract[3]");
                    $deal = $deal->fetch_assoc();
                    $deal_name = $deal['deal_name'];
                    echo($deal_name);
                     ?></td>
                    <td><?= $contract[4]; ?></td>
                    <td><?= $contract[5]; ?></td>
                    <td><?= $contract[6]; ?></td>
                    <td><a class="table-action" style="color: black" href="../Employee/UpdateUser.php?id=<?= $user[0]; ?>">Изменить</a></td>
                    <td><a class="table-action" style="color: #b00d23;" href="../validation-form/DeleteCheck.php?id=<?= $user[0]; ?>">Расторгнуть</a></td>
                  </tr>
                  <?php
                    }
                    $mysql->close();
                  ?>
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </div>
      <?php require "../blocks/footer.php"; ?>
    </div>
  </body>
</html>
