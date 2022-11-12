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
  // $deal_id = $result['deal_id'];
  // $deal = $mysql->query("SELECT * FROM `Deal` WHERE `id` = '$deal_id';");
  // $deal = $deal->fetch_assoc();
  $res = $mysql->query("SELECT SUM(`value`) from Transaction where `value` < 0 and MONTH(`date`) = MONTH(NOW())");
  $row = $res->fetch_row();
  $sum = $row[0];
  $res = $mysql->query("SELECT SUM(`value`) from Transaction where `descr` = 'deal' and MONTH(`date`) = MONTH(NOW())");
  $row = $res->fetch_row();
  $round_deal = $row[0];
  $res = $mysql->query("SELECT SUM(`value`) from Transaction where `descr` = 'service' and MONTH(`date`) = MONTH(NOW())");
  $row = $res->fetch_row();
  $round_service = $row[0];
  $res = $mysql->query("SELECT SUM(`value`) from Transaction where `descr` = 'call' and MONTH(`date`) = MONTH(NOW())");
  $row = $res->fetch_row();
  $round_call = $row[0];

  $p_deal = round($round_deal / $sum * 100);
  $p_service = round($round_service / $sum * 100);
  $p_call = round($round_call / $sum * 100);
  $account_id = $account['id'];
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/css/boot.css">
        <script src="../js/tableSearch.js"></script>
        <title>
            Детализация расходов
        </title>
        <style type="text/css">

        .test-result-table {

            border: 1px solid black;
            width: 800px;
        }

        .test-result-table-header-cell {

            border-bottom: 1px solid black;
            background-color: silver;
        }

        .test-result-step-command-cell {

            border-bottom: 1px solid gray;
        }

        .test-result-step-description-cell {

            border-bottom: 1px solid gray;
        }

        .test-result-step-result-cell-ok {

            border-bottom: 1px solid gray;
            background-color: green;
        }

        .test-result-step-result-cell-failure {

            border-bottom: 1px solid gray;
            background-color: red;
        }

        .test-result-step-result-cell-notperformed {

            border-bottom: 1px solid gray;
            background-color: white;
        }

        .test-result-describe-cell {
            background-color: tan;
            font-style: italic;
        }

        .test-cast-status-box-ok {
            border: 1px solid black;
            float: left;
            margin-right: 10px;
            width: 45px;
            height: 25px;
            background-color: green;
        }

        </style>
    </head>
    <body>
        <h1 class="test-results-header">
            Детализация расходов по номеру <?= $number ?>
        </h1>

        <table class="table table-striped table-sm" id="info-table" cellspacing="0">
            <thead>
                <tr>
                    <td class="test-result-table-header-cell">
                        Дата
                    </td>
                    <td class="test-result-table-header-cell">
                        Тип
                    </td>
                    <td class="test-result-table-header-cell">
                        Сумма
                    </td>
                </tr>
            </thead>
            <tbody>
              <?php
                $users = $mysql->query("SELECT * FROM `Transaction` where `account_id` = '$account_id'");
                $users = mysqli_fetch_all($users);
                foreach ($users as $user) {
              ?>
              <tr>
                <td><?= $user[3]; ?></td>
                <td><?= $user[4]; ?></td>
                <td><?= $user[2]; ?></td>
              </tr>
              <?php
                }
                $mysql->close();
              ?>
            </tbody>
        </table>
    </body>
</html>
