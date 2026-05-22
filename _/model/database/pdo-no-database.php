<?php

try {
  $pdo_no_database = new PDO(
    "mysql:host=localhost;port=3306;charset=utf8mb4",
    "dashboard",
    "development-password",
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_EMULATE_PREPARES => false,
    ]
  );
} catch (PDOException $e) {
  $pdo_no_database = $e;
}
