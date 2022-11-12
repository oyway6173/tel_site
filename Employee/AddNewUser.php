<?php session_start();
header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding("UTF-8");
$mysql = new mysqli('localhost', 'root', 'root', 'telcom-db');
$mysql->set_charset("utf8");
mysqli_set_charset($mysql, 'utf8');
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/boot.css">
    <link rel="stylesheet" type="text/css" href="/fonts/fonts.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" href="/css/chosen.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/chosen.jquery.min.js"></script>
    <script>
    $(document).ready(function(){
    	$('.js-chosen').chosen({
        width: '100%',
    		no_results_text: 'Совпадений не найдено',
        placeholder_text_single: 'Выберите'
    	});
    });
    </script>
    <title>Панель администратора</title>
  </head>
  <body>
    <div class="wrapper">
      <?php require "../blocks/EmployeeHeader.php"; ?>

        <div class="section-title__empl-big"><span class="section-title__red">Данные</span><span> абонента</span></div>
        <section class="new-user">
          <div class="col-md-7 col-lg-8">
            <form class="needs-validation" action="../validation-form/SignUpCheck.php" method="post">
              <div class="row g-3">

                <div class="col-sm-6">
                  <label for="lastName" class="form-label">Фамилия</label>
                  <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Введите фамилию" required="">
                  <div class="invalid-feedback">
                    Необходимо ввести фамилию.
                  </div>
                </div>

                <div class="col-sm-6">
                  <label for="firstName" class="form-label">Имя</label>
                  <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Введите имя" required="">
                  <div class="invalid-feedback">
                    Необходимо ввести имя.
                  </div>
                </div>

                <div class="col-sm-6">
                  <label for="middleName" class="form-label">Отчество</label>
                  <input type="text" class="form-control" name="middleName" id="middleName" placeholder="Введите отчество" required="">
                  <div class="invalid-feedback">
                    Необходимо ввести отчество.
                  </div>
                </div>

                <div class="row g-3">
                  <div class="col-sm-6">
                    <label for="ser" class="form-label">Серия паспорта</label>
                    <input type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="4" name="ser" id="ser" placeholder="Введите серию паспорта" required="">
                    <div class="invalid-feedback">
                      Необходимо ввести серию паспорта
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <label for="pnum" class="form-label">Номер паспорта</label>
                    <input type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="6" name="pnum" id="pnum" placeholder="Введите номер паспорта" required="">
                    <div class="invalid-feedback">
                      Необходимо ввести номер паспорта
                    </div>
                  </div>
                </div>

                <?php
                  if ($_SESSION['wrongPassport'] == true){
                    echo "<span class='warning-label' style='color:red;'>Абонент с подобными реквизитами паспорта уже зарегистрирован</span>";
                    $_SESSION['wrongPassport'] = false;
                  }
                ?>

                <div class="col-12">
                  <label for="dateofb" class="form-label" style='margin-bottom: -.5rem;'>Дата рождения</label>
                </div>

                <div class="col-md-2">
                  <label for="year" class="form-label">Год</label>
                  <input type="number" min="1910" max="2015" maxlength="3" onkeypress='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); return event.charCode >= 48 && event.charCode <= 57' class="form-control" name="year" id="year" placeholder="гггг" required="">
                  <div class="invalid-feedback">
                    Введите год.
                  </div>
                </div>
                <div class="col-md-1">
                  <label for="month" class="form-label">Месяц</label>
                  <input type="number" min="01" max="12" maxlength="1" onkeypress='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); return event.charCode >= 48 && event.charCode <= 57' class="form-control" name="month" id="month" placeholder="мм" required="">
                  <div class="invalid-feedback">
                    Введите месяц.
                  </div>
                </div><div class="col-md-1">
                  <label for="day" class="form-label">День</label>
                  <input type="number" min="01" max="31" maxlength="1" onkeypress='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); return event.charCode >= 48 && event.charCode <= 57' class="form-control" name="day" id="day" placeholder="дд" required="">
                  <div class="invalid-feedback">
                    Введите день.
                  </div>
                </div>


                <div class="col-12">
                  <label for="address" class="form-label">Адрес</label>
                  <input type="text" class="form-control" name="address" id="address" placeholder="Регион, населенный пункт, улица, дом, квартира" required="">
                  <div class="invalid-feedback">
                    Введите адрес.
                  </div>
                </div>

                <div class="col-12">
                  <label for="email" class="form-label">Email <span class="text-muted">(необязательно)</span></label>
                  <input type="text" class="form-control" name="email" id="email" placeholder="email@exapmple.com">
                  <div class="invalid-feedback">
                    Введите email.
                  </div>
                </div>
                <?php
                  if ($_SESSION['wrongEmail'] == true){
                    echo "<span class='warning-label' style='color:red;'>Абонент с таким email уже существует</span>";
                    $_SESSION['wrongEmail'] = false;
                  }
                ?>

              <hr class="my-4">

              <section style="margin-bottom: 20px">
                <label for="number" class="form-label">Выберете номер</label>
                <select class="js-chosen" id="number" name="number" placeholder="Выберите номер" required>
                  <option value=""></option>
                  <?php
                    $numbers = $mysql->query("SELECT `number` FROM `Number` WHERE `occupied` = 'false'");
                    $numbers = mysqli_fetch_all($numbers);
                    foreach ($numbers as $number) {
                  ?>
                	 <option value="<?= $number[0]; ?>"><?= $number[0]; ?></option>
                  <?php
                    }
                  ?>
                </select>

                <label for="deal" class="form-label">Выберете тариф</label>
                <select class="js-chosen" id="deal" name="deal" placeholder="Выберите тариф" required>
                  <option value=""></option>
                  <?php
                    $deals = $mysql->query("SELECT `deal_name` FROM `Deal`");
                    $deals = mysqli_fetch_all($deals);
                    foreach ($deals as $deal) {
                  ?>
                	 <option value="<?= $deal[0]; ?>"><?= $deal[0]; ?></option>
                  <?php
                    }
                  ?>
                </select>
              </section>
              <hr class="my-4">
              <div class="mb-3">
                <button class="confirm_btn" type="submit">Сохранить</button>
                <!-- <button class="confirm_btn" type="submit">Сохранить и перейти к оформлению договора</button> -->
              </div>
            </form>
          </div>
        </section>


      <?php require "../blocks/footer.php";
      $mysql->close();
       ?>
    </div>
  </body>
</html>
