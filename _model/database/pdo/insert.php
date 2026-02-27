<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function insert($table_name, $pairs)
{
  global $pdo;

  $columns = [];
  $values = [];
  foreach ($pairs as $column => $value) { // match $values to $columns
    array_push($columns, "`$column`");
    array_push($values, $value);
  }
  $columns_string = implode(", ", $columns);
  $values_string  = implode(", ", array_fill(0, count($columns), "?"));

  $statement = $pdo->prepare(
    "INSERT INTO dashboard_app.`$table_name` ($columns_string) VALUES ($values_string);"
  );

  $status = $statement->execute($values);
  $id = $pdo->lastInsertId();

  return [$status, $id];
}
