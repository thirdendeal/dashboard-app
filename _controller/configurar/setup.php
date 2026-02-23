<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

$SQL = $_SERVER["DOCUMENT_ROOT"] . "/_model/database/setup.sql";

// ---------------------------------------------------------------------

$_SESSION["setup"] = $pdo->exec(file_get_contents($SQL));
$_SESSION["setup_submit"] = true;

// ---------------------------------------------------------------------

header("Location: /configurar/");
