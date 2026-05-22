<?php

// Drop
// ---------------------------------------------------------------------
//
// From: /configuracoes/
// To:   /configuracoes/

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_/model/database/pdo-no-database.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_/model/database/pdo.php";

// ---------------------------------------------------------------------

$connect = get_class($pdo_no_database) == "PDO";
$database = get_class($pdo) == "PDO";

// ---------------------------------------------------------------------

$drop = null;

if ($connect && $database) {
  $drop = $pdo->exec("DROP DATABASE dashboard_app;");
}

// ---------------------------------------------------------------------

$_SESSION["drop"] = [
  "submitted" => true,
  "connect" => $connect,
  "database" => $database,
  "success" => $drop
];

// ---------------------------------------------------------------------

header("Location: /configuracoes/");
