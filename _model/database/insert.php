<?php

require $_SERVER['DOCUMENT_ROOT'] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function insert($table_name, $pairs)
{
  global $pdo;

  $backticked_columns = [];
  $values = [];

  foreach ($pairs as $column => $value) { // match keys and values order
    $backticked_columns[] = "`$column`";
    $values[] = $value;
  }

  $columns_order = implode(", ", $backticked_columns);
  $values_order  = implode(", ", array_fill(0, count($backticked_columns), "?"));

  return $pdo->prepare(
    "INSERT INTO dashboard_app.`$table_name` ($columns_order) VALUES ($values_order);"
  )->execute($values);
}
