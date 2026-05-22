<?php

// Setup
// ---------------------------------------------------------------------
//
// From: /configuracoes/
// To:   /configuracoes/

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_/model/database/pdo-no-database.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_/model/database/pdo.php";

require $_SERVER["DOCUMENT_ROOT"] . "/_/model/database/pdo/repository.php";

// ---------------------------------------------------------------------

$connect = get_class($pdo_no_database) == "PDO";
$database = get_class($pdo) == "PDO";

// ---------------------------------------------------------------------

$setup = null;

if ($connect && !$database) {
  $setup = Repository::exec($pdo_no_database, "dashboard-app/setup.sql");
}

// ---------------------------------------------------------------------

$_SESSION["setup"] = [
  "submitted" => true,
  "connect" => $connect,
  "database" => $database,
  "success" => $setup
];

// ---------------------------------------------------------------------

header("Location: /configuracoes/");
