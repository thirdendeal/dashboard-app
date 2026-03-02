<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function insert_into($table, $pairs)
{
  global $pdo;

  // Match

  $ordered_columns = [];
  $ordered_values = [];

  foreach ($pairs as $pair_column => $pair_value) {
    $ordered_columns[] = "`$pair_column`";
    $ordered_values[] = $pair_value;
  }

  $columns = implode(", ", $ordered_columns);
  $values  = implode(", ", array_fill(0, count($ordered_values), "?"));

  // Insert

  $statement = $pdo->prepare("INSERT INTO dashboard_app.`$table` ($columns) VALUES ($values);");
  $status    = $statement->execute($ordered_values);

  return $status ? $pdo->lastInsertId() : false;
}
