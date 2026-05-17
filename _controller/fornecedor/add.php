<?php

// Add `Fornecedor`
// ---------------------------------------------------------------------
//
// From: /adicionar-fornecedor/
// To:   /adicionar-fornecedor/

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/insert.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/entity/fornecedor/validate.php";

// Escape
// ---------------------------------------------------------------------

$fields = [
  "nome" => htmlspecialchars(stripslashes(trim($_POST["nome"]))),
  "cnpj" => htmlspecialchars(stripslashes(trim($_POST["cnpj"]))),
  "e-mail" => filter_var($_POST["e-mail"], FILTER_SANITIZE_EMAIL),
  "telefone" => htmlspecialchars(stripslashes(trim($_POST["telefone"])))
];

// Validate
// ---------------------------------------------------------------------

$validate = new \Fornecedor\Validate();

$errors = [
  "nome" => $validate->nome($fields["nome"]),
  "cnpj" => $validate->cnpj($fields["cnpj"]),
  "e-mail" => $validate->email($fields["e-mail"]),
  "telefone" => $validate->telefone($fields["telefone"])
];

// Insert
// ---------------------------------------------------------------------

$success = null;

if (empty(array_filter($errors))) {
  $success = insert(["dashboard_app.fornecedor", $fields]);
}

// ---------------------------------------------------------------------

$_SESSION["add_f"] = [
  "submitted" => true,
  "success" => $success,
  "fields" => $success ?: $fields,
  "errors" => $errors
];

// ---------------------------------------------------------------------

header("Location: /adicionar-fornecedor/");
