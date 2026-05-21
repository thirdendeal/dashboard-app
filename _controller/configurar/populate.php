<?php

// Populate
// ---------------------------------------------------------------------
//
// From: /configurar/
// To:   /configurar/

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo-no-database.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/repository.php";

// ---------------------------------------------------------------------

$connect = get_class($pdo_no_database) == "PDO";
$database = get_class($pdo) == "PDO";

// ---------------------------------------------------------------------

$populate = null;

if ($connect && $database) {
  $populate = Repository::exec($pdo, "dashboard-app/populate.sql");
}

// ---------------------------------------------------------------------

$_SESSION["populate"] = [
  "submitted" => true,
  "connect" => $connect,
  "database" => $database,
  "success" => $populate
];

// ---------------------------------------------------------------------

header("Location: /configurar/");
