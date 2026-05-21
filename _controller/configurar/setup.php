<?php

// Setup
// ---------------------------------------------------------------------
//
// From: /configurar/
// To:   /configurar/

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo-no-database.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/repository.php";

// ---------------------------------------------------------------------

$_SESSION["setup"] = [
  "submitted" => true,
  "success" => Repository::exec($pdo_no_database, "dashboard-app/setup.sql")
];

// ---------------------------------------------------------------------

header("Location: /configurar/");
