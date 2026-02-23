<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function get_rows($table_name)
{
  global $pdo;

  $statement = $pdo->prepare("SELECT * FROM dashboard_app.`$table_name`;");
  $status    = $statement->execute();

  return [$status, $statement];
}
