<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

class Repository
{
  public static function exec($file)
  {
    global $pdo;

    $path = $_SERVER["DOCUMENT_ROOT"] . "/_model/repository/" . $file;

    return $pdo->exec(file_get_contents($path));
  }

  public static function prepare_execute($file, $values)
  {
    global $pdo;

    $path = $_SERVER["DOCUMENT_ROOT"] . "/_model/repository/" . $file;

    $statement = $pdo->prepare(file_get_contents($path));
    $status = $statement->execute($values);

    return $status ? $statement : false;
  }

  public static function query($file)
  {
    global $pdo;

    $path = $_SERVER["DOCUMENT_ROOT"] . "/_model/repository/" . $file;

    return $pdo->query(file_get_contents($path));
  }
}
