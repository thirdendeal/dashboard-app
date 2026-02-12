<?php

require __DIR__ . "/pdo.php";

$pdo->exec(file_get_contents(__DIR__ . "/sql/create.sql"));
