<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function count_from($count, $from)
{
  global $pdo;

  $statement = $pdo->prepare("SELECT COUNT($count) FROM $from");
  $status    = $statement->execute();

  return $status ? $statement->fetchColumn() : false;
}
