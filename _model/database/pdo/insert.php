<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function insert($insert)
{
  global $pdo;

  list($insert, $insert_pairs) = $insert;

  // Match

  $columns = [];
  $values  = [];

  foreach ($insert_pairs as $column => $value) {
    $columns[] = "`$column`";
    $values[]  = $value;
  }

  $insert_columns      = implode(", ", $columns);
  $insert_placeholders = implode(", ", array_fill(0, count($values), "?"));
  $insert_values       = $values;

  // Insert

  $statement = $pdo->prepare("INSERT INTO $insert ($insert_columns) VALUES ($insert_placeholders)");
  $status    = $statement->execute($insert_values);

  return $status ? $pdo->lastInsertId() : false;
}
