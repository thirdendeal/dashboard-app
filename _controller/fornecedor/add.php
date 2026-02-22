<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER['DOCUMENT_ROOT'] . "/_model/database/pdo/insert.php";
require $_SERVER['DOCUMENT_ROOT'] . "/_model/entity/fornecedor/validate.php";

// Escape
// ---------------------------------------------------------------------

$fields = [];

$fields["nome"]     = htmlspecialchars(stripslashes(trim($_POST["nome"])));
$fields["cnpj"]     = htmlspecialchars(stripslashes(trim($_POST["cnpj"])));
$fields["e-mail"]   = filter_var($_POST["e-mail"], FILTER_SANITIZE_EMAIL);
$fields["telefone"] = htmlspecialchars(stripslashes(trim($_POST["telefone"])));

$_SESSION["fields"] = $fields;

// Validate
// ---------------------------------------------------------------------

$validate = new \Fornecedor\Validate();

$errors = [];

$errors["nome"]     = $validate->nome($fields["nome"]);
$errors["cnpj"]     = $validate->cnpj($fields["cnpj"]);
$errors["e-mail"]   = $validate->email($fields["e-mail"]);
$errors["telefone"] = $validate->telefone($fields["telefone"]);

$_SESSION["errors"] = $errors;

// Insert
// ---------------------------------------------------------------------

if (empty(array_filter($errors))) {
  // no errors

  $_SESSION["status"] = insert("fornecedor", $fields);
}

// ---------------------------------------------------------------------

header("Location: /adicionar-fornecedor");
