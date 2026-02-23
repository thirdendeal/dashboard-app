<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

$_SESSION["drop"] = $pdo->exec("DROP DATABASE dashboard_app;");
$_SESSION["drop_submit"] = true;

// ---------------------------------------------------------------------

header("Location: /configurar/");
