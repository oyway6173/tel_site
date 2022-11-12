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
    <title>Список пользователей</title>
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
                    <th>ФИО</th>
                    <th>Серия паспорта</th>
                    <th>Номер паспорта</th>
                    <th>Дата рождения</th>
                    <th>Адрес</th>
                    <th>Email</th>
                    <th>Изменение</th>
                    <th>Удаление</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $users = $mysql->query("SELECT * FROM `User`");
                    $users = mysqli_fetch_all($users);
                    foreach ($users as $user) {
                  ?>

                  <tr>
                    <td><?= $user[0]; ?></td>
                    <td><?= $user[1]; ?></td>
                    <td><?= $user[2]; ?></td>
                    <td><?= $user[3]; ?></td>
                    <td><?= $user[4]; ?></td>
                    <td><?= $user[5]; ?></td>
                    <td><?= $user[6]; ?></td>
                    <td align=center><a class="table-action" style="color: black" href="../Employee/UpdateUser.php?id=<?= $user[0]; ?>">Изменить</a></td>
                    <td align=center><a class="table-action" style="color: #b00d23;" href="../validation-form/DeleteCheck.php?id=<?= $user[0]; ?>">Удалить</a></td>
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
