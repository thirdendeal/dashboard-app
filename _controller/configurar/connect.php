<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php"; // throws on error

// ---------------------------------------------------------------------

$_SESSION["connect"] = true;
$_SESSION["connect_submit"] = true;

// ---------------------------------------------------------------------

header("Location: /configurar/");
