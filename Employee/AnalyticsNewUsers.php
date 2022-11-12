<?php
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
$account_id = $account['id'];
// $deal_id = $result['deal_id'];
// $deal = $mysql->query("SELECT * FROM `Deal` WHERE `id` = '$deal_id';");
// $deal = $deal->fetch_assoc();
for ($i = 1; $i <= 7; $i++) {
  $res = $mysql->query("SELECT count(*) FROM `Contract` where `date` = curdate() - interval $i day");
  $row = $res->fetch_row();
  $arr_count[$i] = $row[0];
}
for ($i = 1; $i <= 7; $i++) {
  $res = $mysql->query("SELECT `date` FROM `Contract` where `date` = curdate() - interval $i day limit 1");
  $row = $res->fetch_row();
  $arr_date[$i] = $row[0];
}
$res = $mysql->query("SELECT count(*) FROM `Contract` where `date` > curdate() - interval 7 day");
$row = $res->fetch_row();
$new_count = $row[0];
// $res = $mysql->query("SELECT count(*) FROM `Contract` where `date` = curdate() - interval 1 day");
// $row = $res->fetch_row();
// $arr_count[0] = $row[0];

?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <link rel="stylesheet" type="text/css" href="/css/boot.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <link rel="stylesheet" type="text/css" href="/fonts/fonts.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script src="../js/tableSearch.js"></script>
    <title>Аналитика</title>
  </head>
  <body>
    <div class="wrapper">
      <?php require "../blocks/EmployeeHeader.php"; ?>
      <div class="limit">
        <div class="container">
          <div class="section-title__empl-big"><span class="section-title__red">Отчет</span><span> "Подключения"</span></div>
          <div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse" style="background: #f4f6f8;">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../Employee/AnalyticsNewUsers.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
              Подключения
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Employee/AnalyticsDemand.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
              Спрос (тарифы)
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Employee/AnalyticsDemandServices.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
              Спрос (услуги)
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Employee/AnalyticsPayment.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
              Задолженности
            </a>
          </li>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 bg-white px-md-4" style="margin-bottom: 30px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h1 class="h2">Подключения за неделю</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            19.05.2021-26.05.2021
          </button>
        </div>
      </div>

      <canvas class="my-4 w-100 chartjs-render-monitor" id="myChart" width="1434" height="604" style="display: block; height: 302px; width: 717px;"></canvas>
      <h2 style="color: #b00d23; text-align: right;">Подключений за неделю: <?= $new_count ?></h2>
      <h2 style="margin-bottom: 10px;">Новые подключения</h2>
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
              </tr>
              <?php
                }

              ?>
            </tbody>
          </table>
        </div>
      </section>
    </main>
  </div>
</div>
        </div>
      </div>
      <?php require "../blocks/footer.php"; ?>
    </div>
    <script>
            var Lat='<?= $arr_count[1] ?>';
            var Two='<?= $arr_count[2] ?>';
            var Three='<?= $arr_count[3] ?>';
            var Four='<?= $arr_count[4] ?>';
            var Five='<?= $arr_count[5] ?>';
            var Six='<?= $arr_count[6] ?>';
            var Seven='<?= $arr_count[7] ?>';
            var Mon='<?= $arr_date[7] ?>';
            var Tue='<?= $arr_date[6] ?>';
            var Wed='<?= $arr_date[5] ?>';
            var Thu='<?= $arr_date[4] ?>';
            var Fri='<?= $arr_date[3] ?>';
            var Sat='<?= $arr_date[2] ?>';
            var Sun='<?= $arr_date[1] ?>';

    </script>
    <script src="../js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="../js/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="../js/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="../js/dashboard.js"></script>
  </body>
</html>
