<?php

$pdo = new PDO(
    "mysql:host=localhost;port=3306;charset=utf8mb4", // dsn
    "dashboard",                                      // username
    "development-password",                           // password
    [
        PDO::ATTR_ERRMODE          => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
);

echo "<span style=\"background-color: green; color: white; padding: 0.25rem; font-family: sans-serif\">OK<span/>";
