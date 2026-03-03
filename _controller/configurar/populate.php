<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/repository-exec.php";

// ---------------------------------------------------------------------

$_SESSION["populate"] = repository_exec("dashboard-app/populate.sql");
$_SESSION["populate_submit"] = true;

// ---------------------------------------------------------------------

header("Location: /configurar/");
