<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function count_rows($table_name, $column)
{
  global $pdo;

  $statement = $pdo->prepare("SELECT COUNT(`$column`) FROM dashboard_app.`$table_name`");
  $status    = $statement->execute();

  return [$status, $statement];
}
