<?php
  $my = new mysqli('localhost', 'root', 'root', 'telcom-db');
  $empl_idd = $_COOKIE['empl'];
  $empl = $my->query("SELECT `employee_name` FROM `Employee` WHERE `id` = '$empl_idd'");
  $empl = $empl->fetch_assoc();
  $empl_namee = $empl['employee_name'];
?>
<header>
  <div class="header__top">
    <div class="container">
      <div class="header__reg"><a class="header__login-adm" href="#"><?= $empl_namee ?></a></div>
      <ul class="header__social">
        <li><a class="header-social__link header-admin__link" href="javascript:void(0);"></a></li>
        <li><p>Сотрудник</p></li>
      </ul>
    </div>
  </div>
  <div class="header__bottom clearfix">
    <div class="container">
      <!--.header__logo-->
      <!--	img(src="static/img/general/logo.png")-->
      <nav class="header-nav">

        <ul class="header-nav__list">
          <li><a class="header-nav__logo" href="/index.php"><img src="/img/general/logo.png"></a></li>
          <li>
            <div class="dropdown">
              <button class="dropbtn">Списки</button>
              <div class="dropdown-content">
                <a href="../Employee/ListOfUsers.php">Абоненты</a>
                <a href="../Employee/ListOfContractsForm.php">Договоры</a>
              </div>
            </div>
          </li>
          <li>
            <div class="dropdown">
              <button class="dropbtn">Добавление</button>
              <div class="dropdown-content">
                <a href="../Employee/AddNewUser.php">Абоненты</a>
                <a href="../Employee/AddNewContractForm.php">Создать</a>
              </div>
            </div>
          </li>
          <!-- <li>
            <div class="dropdown">
              <button class="dropbtn">Аналитика</button>
              <div class="dropdown-content">
                <a href="../Employee/AnalyticsDemand.php">Спрос</a>
                <a href="#">Подключения</a>
                <a href="#">Анализ задолженностей</a>
              </div>
            </div>
          </li> -->
          <li><a href="../Employee/AnalyticsNewUsers.php">Аналитика</a></li>
          <!-- <li><a href="products-all.html">Услуги</a></li>
          <li><a href="javascript:void(0);">Отзывы</a></li> -->
        </ul>
      </nav>
      <div class="header-action">
        <a href="/exit.php" class="square_btn">Выход</a>
      </div>
    </div>
  </div>
</header>
