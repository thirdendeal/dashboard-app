<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function find_rows($table_name, $column, $value)
{
  global $pdo;

  $statement = $pdo->prepare("SELECT * FROM dashboard_app.`$table_name` WHERE `$column` = ?;");
  $status    = $statement->execute([$value]);

  return [$status, $statement];
}
