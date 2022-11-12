<!DOCTYPE html>
<html lang="ru">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/fonts/fonts.css">
  <link rel="stylesheet" type="text/css" href="/css/main.css">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <title>PHP веб-сайт</title>
 </head>
 <body>

    <?php require "blocks/header.php" ?>

    <h3 class="mb-5">Наши предложения</h3>

    <div class="d-flex flex-wrap">
      <?php
        for($i = 0; $i < 5; $i++):
      ?>
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h4 class="my-0 fw-normal">Просто текст</h4>
          </div>
          <div class="card-body">
            <img src="img/<?php echo ($i + 1)  ?>.JPG" class = "img-thumbnail">
            <ul class="list-unstyled mt-3 mb-4">
              <li>10 users included</li>
              <li>2 GB of storage</li>
              <li>Email support</li>
              <li>Help center access</li>
            </ul>
            <button type="button" class="w-100 btn btn-lg btn-outline-primary">Подробнее</button>
          </div>
        </div>
    <?php endfor; ?>
  </div>
  </div>

  <?php require "blocks/footer.php" ?>

 </body>
</html>

<!-- <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-body border-bottom shadow-sm">
  <h5 class="h5 my-0 mr-md-auto fw-normal">Memes Inc.</h5>
<nav class="my-2 my-md-0 me-md-3">
    <a class="p-2 text-dark" href="/">Главная</a>
    <a class="p-2 text-dark" href="/about.php">Контакты</a>
</nav>
<?php
  if($_COOKIE['user'] == 'true'):
 ?>
  <a class="btn btn-outline-primary" href="/auth.php">Кабинет пользователя</a>
  <?php else: ?>
  <a class="btn btn-outline-primary" href="/auth.php">Войти</a>
  <?php endif; ?>
</div>
<div class="container mt-5"> -->
