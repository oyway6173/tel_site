<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/signin.css">
  <title>Форма авторизации сотрудника</title>
 </head>
 <body class="text-center">
   <main class="form-signin">
     <?php
       if($_COOKIE['empl'] == ''):
     ?>
       <form action="/validation-form/SignInCheck.php" method="post">
         <img class="mb-4" src="/img/general/logo.png" alt="" width="91" height="30">
         <h1 class="h4 mb-3 fw-normal">Авторизация сотрудника</h1>
         <label for="inputEmail" class="visually-hidden">Логин</label>
         <input type="text" class="form-control" name="e-login" id="e-login" placeholder="Введите логин" required autofocus>
         <label for="inputPassword" class="visually-hidden">Пароль</label>
         <input type="password" class="form-control" name="e-pass" id="e-pass" placeholder="Введите пароль" required>
         <?php
           if ($_SESSION['errorMessage'] == true){
             echo "<span class='mb-3' style='color:red;'>Неверная связка логина и пароля</span>";
             $_SESSION['errorMessage'] = false;
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
     <?php else: ?>
       <?php header("Location: /Employee/EmployeeMainForm.php"); ?>
       <!-- <p>Привет, <?=$_COOKIE['empl']?>. Чтобы выйти нажмите <a href = "/exit.php">здесь</a>.</p> -->
     <?php endif; ?>
   </main>

 </body>
</html>
