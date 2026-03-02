<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function select_all_rows($table)
{
  global $pdo;

  $statement = $pdo->prepare("SELECT * FROM dashboard_app.`$table`;");
  $status    = $statement->execute();

  return $status ? $statement : false;
}
