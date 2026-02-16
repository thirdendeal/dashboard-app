<?php

require $_SERVER['DOCUMENT_ROOT'] . "/_model/database/pdo.php";

$pdo->exec(file_get_contents(
  $_SERVER['DOCUMENT_ROOT'] . "/_model/database/create.sql"
));
