<?php

setcookie('empl', $user['employee_name'], time() - 3600, "/");
header('Location: /');

 ?>
