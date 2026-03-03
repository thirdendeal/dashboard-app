<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function select_from($select, $from)
{
  global $pdo;

  $statement = $pdo->prepare("SELECT $select FROM $from");
  $status    = $statement->execute();

  return $status ? $statement : false;
}
