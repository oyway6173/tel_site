<?php
// Кол-во элементов
$limit = 3;

// Подключение к БД
$mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');
// Получение записей для текущей страницы
$page = intval(@$_GET['page']);
$page = (empty($page)) ? 1 : $page;
$start = ($page != 1) ? $page * $limit - $limit : 0;
$sth = $mysql->query("SELECT SQL_CALC_FOUND_ROWS * FROM `Number` LIMIT $start, $limit");
$items = mysqli_fetch_all($sth);

foreach ($items as $row) {
	?>
  <div class="d-flex text-muted pt-3">
    <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="../img/content/products/product5.png" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#b00d23"></rect><text x="50%" y="50%" fill="#b00d23" dy=".3em"></text></svg>

    <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
      <div class="d-flex justify-content-between">
        <strong class="text-gray-dark" style="font-size: 1.143rem;"><?= $row[1]; ?></strong>
        <a href="#" style="color: #b00d23;">Отключить.</a>
      </div>
      <span class="d-block"> ₽/день</span>
    </div>
  </div>
	<?php


}
