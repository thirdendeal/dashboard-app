<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function update_where($table, $column, $value, $pairs)
{
  global $pdo;

  // Match

  $ordered_assigments = [];
  $ordered_values = [];

  foreach ($pairs as $pair_column => $pair_value) {
    $ordered_assigments[] = "`$pair_column` = ?";
    $ordered_values[] = $pair_value;
  }

  $assigments = implode(", ", $ordered_assigments);

  // Update

  $statement = $pdo->prepare("UPDATE dashboard_app.`$table` SET $assigments WHERE `$column` = ?;");
  $status    = $statement->execute([...$ordered_values, $value]);

  return $status ? $pdo->lastInsertId() : false;
}
