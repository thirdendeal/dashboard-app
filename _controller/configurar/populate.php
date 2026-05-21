<?php

// Populate
// ---------------------------------------------------------------------
//
// From: /configurar/
// To:   /configurar/

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/repository.php";

// ---------------------------------------------------------------------

$_SESSION["populate"] = [
  "submitted" => true,
  "success" => Repository::exec($pdo, "dashboard-app/populate.sql")
];

// ---------------------------------------------------------------------

header("Location: /configurar/");
