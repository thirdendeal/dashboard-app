<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function select_from_where($select, $from, $where)
{
  global $pdo;

  list($where, $where_values) = $where;

  $statement = $pdo->prepare("SELECT $select FROM $from WHERE $where");
  $status    = $statement->execute($where_values);

  return $status ? $statement : false;
}
