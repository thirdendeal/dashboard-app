<?php

// Repository
// ---------------------------------------------------------------------

class Repository
{
  public static function exec($pdo, $file)
  {
    if (get_class($pdo) == "PDOException") {
      return $pdo;
    }

    $path = $_SERVER["DOCUMENT_ROOT"] . "/_/model/repository/" . $file;

    return $pdo->exec(file_get_contents($path));
  }

  public static function prepare_execute($pdo, $file, $values)
  {
    if (get_class($pdo) == "PDOException") {
      return $pdo;
    }

    $path = $_SERVER["DOCUMENT_ROOT"] . "/_/model/repository/" . $file;

    $statement = $pdo->prepare(file_get_contents($path));
    $status = $statement->execute($values);

    return $status ? $statement : false;
  }

  public static function query($pdo, $file)
  {
    if (get_class($pdo) == "PDOException") {
      return $pdo;
    }

    $path = $_SERVER["DOCUMENT_ROOT"] . "/_/model/repository/" . $file;

    return $pdo->query(file_get_contents($path));
  }
}
