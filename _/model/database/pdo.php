<?php

try {
  $pdo = new PDO(
    "mysql:host=localhost;dbname=dashboard_app;port=3306;charset=utf8mb4",
    "dashboard",
    "development-password",
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_EMULATE_PREPARES => false,
    ]
  );
} catch (PDOException $e) {
  $pdo = $e;
}
