<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/css/boot.css">
  <link rel="stylesheet" href="/css/signin.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="/js/jquery.inputmask.min.js"></script>
  <title>Форма авторизации абонента</title>
 </head>
 <body class="text-center">
   <main class="form-signin">
     <?php
       if($_COOKIE['abonent'] == ''):
     ?>

         <img class="mb-4" src="/img/general/logo.png" alt="" width="91" height="30">
         <h1 class="h4 mb-3 fw-normal">Авторизация абонента</h1>
         <div class="tabs">
          <input type="radio" name="tabs" id="tabone" checked="checked">
          <label for="tabone">Вход по паролю</label>
          <div class="tab">
            <form action="../User/UserLogInCheck.php" method="post">
              <label for="number" class="form-label">Номер телефона</label>
              <input type="text" class="form-control phone" name="u-number" id="u-number" required autofocus>
              <label for="number" class="form-label">Пароль</label>
              <input type="password" class="form-control" name="u-pass" id="u-pass" placeholder="Введите пароль" required>
              <?php
                if ($_SESSION['errorNumber'] == true){
                  echo "<span class='mb-3' style='color:red;'>Неверный номер</span>";
                  $_SESSION['errorNumber'] = false;
                }
                if ($_SESSION['errorPassword'] == true){
                  echo "<span class='mb-3' style='color:red;'>Неверный пароль</span>";
                  $_SESSION['errorPassword'] = false;
                }
              ?>
              <div class="checkbox mb-3">
                <label>
                  <input type="checkbox" value="remember-me"> Запомнить меня
                </label>
              </div>
              <button class="w-100 btn btn-success btn-lg btn-prim" type="submit">Войти</button>
              <p class="mt-5 mb-3 text-muted">&copy; <a href = "/">2021 TELCOM</a></p>
            </form>
          </div>

          <input type="radio" name="tabs" id="tabtwo">
          <label for="tabtwo">Вход по смс</label>
          <div class="tab">
            <h1>Tab Two Content</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
        </div>


     <?php else: ?>
       <?php header("Location: ../index.php"); ?>
       <!-- <p>Привет, <?=$_COOKIE['empl']?>. Чтобы выйти нажмите <a href = "/exit.php">здесь</a>.</p> -->
     <?php endif; ?>
   </main>
    <script>
      $(document).ready(function(){
        $(".phone").inputmask("+7 (999) 999-9999");
      });
    </script>
 </body>
</html>
