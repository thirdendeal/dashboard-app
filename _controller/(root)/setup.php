<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/repository.php";

// ---------------------------------------------------------------------

$_SESSION["setup"] = Repository::exec("dashboard-app/setup.sql");
$_SESSION["setup_submit"] = true;

// ---------------------------------------------------------------------

header("Location: /");
