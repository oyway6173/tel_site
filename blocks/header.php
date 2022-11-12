<?php
  if($_COOKIE['abonent'] == ''):
?>
<header>
  <div class="header__top">
    <div class="container">
      <!--.header__contacts-->
      <!--	a(href="mailto:info@telcom.com").header__mail info@telcom.com-->
      <!--	a(href="tel: 88005553535").header__phone 8(800)555-35-35-->
      <div class="header__reg"><a class="header__register" href="../Employee/EmployeeLogInForm.php">Сотрудникам</a></div>
      <ul class="header__social">
        <li><a class="header-social__link header-social__link--fb" href="javascript:void(0);"></a></li>
        <li><a class="header-social__link header-social__link--tw" href="javascript:void(0);"></a></li>
        <li><a class="header-social__link header-social__link--google" href="javascript:void(0);"></a></li>
        <li><a class="header-social__link header-social__link--instagram" href="javascript:void(0);"></a></li>
      </ul>
    </div>
  </div>
  <div class="header__bottom clearfix">
    <div class="container">
      <!--.header__logo-->
      <!--	img(src="static/img/general/logo.png")-->
      <nav class="header-nav">
        <ul class="header-nav__list">
          <li><a class="header-nav__logo" href="../index.php"><img src="../img/general/logo.png"></a></li>
          <li><a href="../pages/deals.php">Тарифы</a></li>
          <li><a href="../pages/numbers.php">Номера</a></li>
          <li><a href="../pages/services.php">Услуги</a></li>
          <li><a href="products-all.html">Маркет</a></li>
          <li><a href="javascript:void(0);">Оплата</a></li>
        </ul>
      </nav>
      <div class="header-action">
        <a href="../User/UserLogInForm.php" class="square_btn">Войти в личный кабинет</a>
      </div>
    </div>
  </div>
</header>
<?php else: ?>
  <header>
    <div class="header__top">
      <div class="container">
        <?php
        $mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');
        $contract_id = $_COOKIE['abonent'];
        $result = $mysql->query("SELECT * FROM `Contract` WHERE `id` = '$contract_id'");
        $contract = $result->fetch_assoc();
        $number = $contract['number'];

        $number = substr($number, 0, 3)." ".substr($number, 3, 3)." ".substr($number, 6, 2)." ".substr($number, 8, 2);
        $number = "+7 ".$number;
        // $user_id = $contract['user_id'];
        // $result = $mysql->query("SELECT `fio` FROM `User` WHERE `id` = '$user_id'");
        // $user_name = $result->fetch_assoc();
        // $user_name = $user_name['fio'];
        ?>
        <div class="header__reg"><a class="header__register" href="#"><?= $number ?></a></div>
        <ul class="header__social">
          <li><a class="header-social__link header-social__link--fb" href="https://www.facebook.com"></a></li>
          <li><a class="header-social__link header-social__link--tw" href="https://twitter.com"></a></li>
          <li><a class="header-social__link header-social__link--google" href="https://myaccount.google.com/"></a></li>
          <li><a class="header-social__link header-social__link--instagram" href="https://www.instagram.com"></a></li>
        </ul>
      </div>
    </div>
    <div class="header__bottom clearfix">
      <div class="container">
        <!--.header__logo-->
        <!--	img(src="static/img/general/logo.png")-->
        <nav class="header-nav">
          <ul class="header-nav__list">
            <li><a class="header-nav__logo" href="../index.php"><img src="../img/general/logo.png"></a></li>
            <li><a href="../pages/deals.php">Тарифы</a></li>
            <li><a href="../pages/numbers.php">Номера</a></li>
            <li><a href="../pages/services.php">Услуги</a></li>
            <li><a href="products-all.html">Маркет</a></li>
            <li><a href="javascript:void(0);">Оплата</a></li>
          </ul>
        </nav>
        <div class="header-action">
          <a href="../User/UserExit.php" class="square_btn">Выйти из личного кабинета</a>
        </div>
      </div>
    </div>
    <div class="header__lk clearfix">
      <div class="container">
        <!--.header__logo-->
        <!--	img(src="static/img/general/logo.png")-->
        <nav class="header-nav">
          <ul class="header-nav__list">
            <li><a href="../User/LKmain.php">Обзор</a></li>
            <li><a href="../User/LKdeal.php">Тариф и остатки</a></li>
            <li><a href="../User/LKservice.php">Услуги</a></li>
            <li><a href="../User/LKprofile.php">Расходы</a></li>
            <li><a href="../User/LKsettings.php">Настройки</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </header>
<?php endif; ?>
