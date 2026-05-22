<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_/model/database/pdo.php";

// ---------------------------------------------------------------------

function delete_where($delete, $where)
{
  global $pdo;

  if (get_class($pdo) == "PDOException") {
    return $pdo;
  }

  [$where, $values] = $where;

  $statement = $pdo->prepare("DELETE FROM $delete WHERE $where");
  $status = $statement->execute($values);

  return $status;
}
