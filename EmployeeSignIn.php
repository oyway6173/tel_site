<!--Удалить ппж-->
<!DOCTYPE html>
<html lang="ru">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Форма регистрации</title>
 </head>
 <body>
  <div class="container d-flex mt-4">
    <?php
      if($_COOKIE['empl'] == ''):
    ?>
      <div class="col">
        <h1>Форма регистрации</h1>
        <form action="../validation-form/SignUpCheck.php" method="post">
          <input type="tel" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="11" class="form-control" name="login" id="login" placeholder="+7"><br>
          <input type="text" class="form-control" name="name" id="name" placeholder="Введите ФИО"><br>
          <input type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="4" name="ser" id="ser" placeholder="Введите серию паспорта"><br>
          <input type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="6" name="pnum" id="pnum" placeholder="Введите номер паспорта"><br>
          <input type="date" class="form-control" name="dateofb" id="dateofb" placeholder="Введите дату рождения"><br>
          <input type="text" class="form-control" name="pass" id="pass" placeholder="Введите СМС-код подтверждения"><br>
          <input type="text" class="form-control" name="address" id="address" placeholder="Введите адрес"><br>
          <input type="text" class="form-control" name="email" id="email" placeholder="email (необязательно)"><br>
          <button class="btn btn-success" type="submit">Зарегистровать</button>
        </form>
      </div>
      <div class="col">
        <h1>Форма авторизации сотрудника</h1>
        <form action="validation-form/SignInCheck.php" method="post">
          <input type="text" class="form-control" name="e-login" id="e-login" placeholder="Введите логин"><br>
          <input type="text" class="form-control" name="e-pass" id="e-pass" placeholder="Введите пароль"><br>
          <button class="btn btn-success" type="submit">Войти</button>
        </form>
      </div>

    <?php else: ?>
      <p>Привет, <?=$_COOKIE['empl']?>. Чтобы выйти нажмите <a href = "/exit.php">здесь</a>.</p>

    <?php endif; ?>

  </div>

 </body>
</html>
