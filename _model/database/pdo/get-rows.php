<?php

require $_SERVER['DOCUMENT_ROOT'] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function get_rows($table_name)
{
  global $pdo;

  $rows = $pdo->prepare("SELECT * FROM dashboard_app.`$table_name`;");
  $status = $rows->execute();

  return [$status, $rows];
}
