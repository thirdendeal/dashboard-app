<?php

// Drop
// ---------------------------------------------------------------------
//
// From: /configurar/
// To:   /configurar/

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

$_SESSION["drop"] = [
  "submitted" => true,
  "success" => $pdo->exec("DROP DATABASE dashboard_app;")
];

// ---------------------------------------------------------------------

header("Location: /configurar/");
