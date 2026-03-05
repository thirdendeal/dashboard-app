<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function delete_where($delete, $where)
{
  global $pdo;

  [$where, $values] = $where;

  $statement = $pdo->prepare("DELETE FROM $delete WHERE $where");
  $status = $statement->execute($values);

  return $status;
}
