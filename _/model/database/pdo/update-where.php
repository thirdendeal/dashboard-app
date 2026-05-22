<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_/model/database/pdo.php";

// ---------------------------------------------------------------------

function update_where($update, $where)
{
  global $pdo;

  if (get_class($pdo) == "PDOException") {
    return $pdo;
  }

  list($update, $update_pairs) = $update;
  list($where, $where_values) = $where;

  // Match

  $assigments = [];
  $values = [];

  foreach ($update_pairs as $column => $value) {
    $assigments[] = "`$column` = ?";
    $values[] = $value;
  }

  $update_assigments = implode(", ", $assigments);
  $update_values = $values;

  // Update

  $statement = $pdo->prepare("UPDATE $update SET $update_assigments WHERE $where");
  $status = $statement->execute([...$update_values, ...$where_values]);

  return $status;
}
