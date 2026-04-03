<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/repository.php";

// ---------------------------------------------------------------------

$_SESSION["populate"] = Repository::exec("dashboard-app/populate.sql");
$_SESSION["populate_submit"] = true;

// ---------------------------------------------------------------------

header("Location: /");
