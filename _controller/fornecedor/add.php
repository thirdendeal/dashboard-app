<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/insert.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/entity/fornecedor/validate.php";

// Escape
// ---------------------------------------------------------------------

$fields = [
  "nome"     => htmlspecialchars(stripslashes(trim($_POST["nome"]))),
  "cnpj"     => htmlspecialchars(stripslashes(trim($_POST["cnpj"]))),
  "e-mail"   => filter_var($_POST["e-mail"], FILTER_SANITIZE_EMAIL),
  "telefone" => htmlspecialchars(stripslashes(trim($_POST["telefone"])))
];

$_SESSION["fields"] = $fields;

// Validate
// ---------------------------------------------------------------------

$validate = new \Fornecedor\Validate();

$errors = [
  "nome"     => $validate->nome($fields["nome"]),
  "cnpj"     => $validate->cnpj($fields["cnpj"]),
  "e-mail"   => $validate->email($fields["e-mail"]),
  "telefone" => $validate->telefone($fields["telefone"])
];

$_SESSION["errors"] = $errors;

// Insert
// ---------------------------------------------------------------------

if (empty(array_filter($errors))) {
  $_SESSION["status"] = insert("fornecedor", $fields);
}

// ---------------------------------------------------------------------

$_SESSION["submitted"] = true;

// ---------------------------------------------------------------------

header("Location: /adicionar-fornecedor/");
