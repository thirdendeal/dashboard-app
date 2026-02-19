<?php

require $_SERVER['DOCUMENT_ROOT'] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function get_table($table_name)
{
  global $pdo;

  $rows = $pdo->prepare("SELECT * FROM dashboard_app.`$table_name`;");
  $rows->execute();
  $headers = $rows->fetch(PDO::FETCH_ASSOC);

  if ($headers)
    $headers = array_keys($headers);

  $rows = $pdo->prepare("SELECT * FROM dashboard_app.`$table_name`;");
  $rows->execute();

  return [$headers, $rows];
}
