<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function get_row($table_name, $pk_column, $pk_value)
{
  global $pdo;

  $statement = $pdo->prepare("SELECT * FROM dashboard_app.`$table_name` WHERE `$pk_column` = ?;");
  $status    = $statement->execute([$pk_value]);

  return [$status, $statement];
}
