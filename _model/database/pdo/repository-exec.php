<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function repository_exec($file)
{
  global $pdo;

  $path = $_SERVER["DOCUMENT_ROOT"] . "/_model/repository/" . $file;

  return $pdo->exec(file_get_contents($path));
}
