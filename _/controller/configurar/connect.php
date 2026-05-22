<?php

// Connect
// ---------------------------------------------------------------------
//
// From: /configurar/
// To:   /configurar/

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_/model/database/pdo-no-database.php";

// ---------------------------------------------------------------------

$_SESSION["connect"] = [
  "submitted" => true,
  "success" => get_class($pdo_no_database) == "PDO"
];

// ---------------------------------------------------------------------

header("Location: /configurar/");
