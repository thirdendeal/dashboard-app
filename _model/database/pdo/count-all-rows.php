<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function count_all_rows($table)
{
  global $pdo;

  $statement = $pdo->prepare("SELECT COUNT(*) FROM dashboard_app.`$table`");
  $status    = $statement->execute();

  return $status ? $statement->fetchColumn() : false;
}
