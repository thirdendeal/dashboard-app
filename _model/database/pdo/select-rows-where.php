<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function select_rows_where($table, $column, $value)
{
  global $pdo;

  $statement = $pdo->prepare("SELECT * FROM dashboard_app.`$table` WHERE `$column` = ?;");
  $status    = $statement->execute([$value]);

  return $status ? $statement : false;
}
