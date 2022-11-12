<?php

setcookie('abonent', $contract_id, time() - 7200, "/");
header('Location: /');

?>
