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
for ($i = 1; $i <= 3; $i++) {
  $res = $mysql->query("SELECT count(*) FROM `Extra` where `service_id` = '$i'");
  $row = $res->fetch_row();
  $arr_deals[$i] = $row[0];
}
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
          <div class="section-title__empl-big"><span class="section-title__red">Отчет</span><span> "Спрос на услуги"</span></div>
          <div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse" style="background: #f4f6f8;">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../Employee/AnalyticsNewUsers.php">
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

        <h1 class="h2">Сравнение услуг</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
          </div>
        </div>
      </div>

      <div id="chartContainer" style="height: 370px; width: 100%;"></div>



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
    <script src="../js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="../js/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="../js/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script type="text/javascript">
      window.onload = function () {

      var chart = new CanvasJS.Chart("chartContainer", {
      	theme: "light1", // "light2", "dark1", "dark2"
      	animationEnabled: false, // change to true
      	title:{
      		text: "Сравнение спроса на услуги"
      	},
      	data: [
      	{
      		// Change type to "bar", "area", "spline", "pie",etc.
      		type: "column",
      		dataPoints: [
      			{ label: "Кто звонит?",  y: <?= $arr_deals[1] ?> },
      			{ label: "Блокировка рекламы", y: <?= $arr_deals[2] ?>  },
      			{ label: "Черный список", y: <?= $arr_deals[3] ?>  }
      		]
      	}
      	]
      });
    chart.render();
      }
  </script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
  </body>
</html>
