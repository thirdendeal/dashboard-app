<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

$SQL = $_SERVER["DOCUMENT_ROOT"] . "/_model/database/populate.sql";

// ---------------------------------------------------------------------

$_SESSION["populate"] = $pdo->exec(file_get_contents($SQL));
$_SESSION["populate_submit"] = true;

// ---------------------------------------------------------------------

header("Location: /configurar/");
