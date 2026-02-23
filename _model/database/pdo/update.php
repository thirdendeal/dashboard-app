<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function update($table_name, $pk_column, $pk_value, $pairs)
{
  global $pdo;

  $set_assigments = [];
  $values = [];
  foreach ($pairs as $column => $value) { // match $values to $set_assigments
    array_push($set_assigments, "`$column` = ?");
    array_push($values, $value);
  }
  $set_string = implode(", ", $set_assigments);

  $statement = $pdo->prepare(
    "UPDATE dashboard_app.`$table_name` SET $set_string WHERE `$pk_column` = ?;"
  );

  $status = $statement->execute([...$values, $pk_value]);

  return $status;
}
