<?php

// Connect
// ---------------------------------------------------------------------
//
// From: /configurar/
// To:   /configurar/

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php"; // throws on error

// ---------------------------------------------------------------------

$_SESSION["connect"] = [
  "submitted" => true,
  "success" => true // throws on error
];

// ---------------------------------------------------------------------

header("Location: /configurar/");
