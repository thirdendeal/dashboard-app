<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/insert.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/entity/produto/validate.php";

// Escape
// ---------------------------------------------------------------------

$fields = [
  "nome"      => htmlspecialchars(stripslashes(trim($_POST["nome"]))),
  "descrição" => htmlspecialchars(stripslashes(trim($_POST["descrição"]))),
  "código"    => htmlspecialchars(stripslashes(trim($_POST["código"])))
];

$_SESSION["fields"] = $fields;

// Validate
// ---------------------------------------------------------------------

$validate = new \Produto\Validate();

$errors = [
  "nome"      => $validate->nome($fields["nome"]),
  "descrição" => $validate->desc($fields["descrição"]),
  "código"    => $validate->code($fields["código"])
];

$_SESSION["errors"] = $errors;

// Insert
// ---------------------------------------------------------------------

if (empty(array_filter($errors))) {
  $_SESSION["status"] = insert("produto", $fields);
}

// ---------------------------------------------------------------------

$_SESSION["submitted"] = true;

// ---------------------------------------------------------------------

header("Location: /adicionar-produto/");
