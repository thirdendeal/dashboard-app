<?php

require $_SERVER['DOCUMENT_ROOT'] . "/_model/pdo.php";

$pdo->exec(file_get_contents(
  $_SERVER['DOCUMENT_ROOT'] . "/_model/create.sql"
));
