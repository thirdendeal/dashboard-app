<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/repository-exec.php";

// ---------------------------------------------------------------------

$_SESSION["setup"] = repository_exec("dashboard-app/setup.sql");
$_SESSION["setup_submit"] = true;

// ---------------------------------------------------------------------

header("Location: /configurar/");
