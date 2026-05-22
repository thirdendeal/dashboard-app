<?php

// Database
// ---------------------------------------------------------------------
//
// From: /configurar/
// To:   /configurar/

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_/model/database/pdo-no-database.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_/model/database/pdo.php";

// ---------------------------------------------------------------------

$_SESSION["database"] = [
  "submitted" => true,
  "connect" => get_class($pdo_no_database) == "PDO",
  "success" => get_class($pdo) == "PDO"
];

// ---------------------------------------------------------------------

header("Location: /configurar/");
