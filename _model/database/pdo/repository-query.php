<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function repository_query($file)
{
  global $pdo;

  $path = $_SERVER["DOCUMENT_ROOT"] . "/_model/repository/" . $file;

  return $pdo->query(file_get_contents($path));
}
