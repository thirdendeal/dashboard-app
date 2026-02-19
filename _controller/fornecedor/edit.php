<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER['DOCUMENT_ROOT'] . "/_model/database/update.php";
require $_SERVER['DOCUMENT_ROOT'] . "/_model/entity/fornecedor/validate.php";

// Parse
// ---------------------------------------------------------------------

parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY), $query);

$id = $query["id"];

// Escape and validate
// ---------------------------------------------------------------------

$validate = new \Fornecedor\Validate();

if (isset($_POST["nome"])) {
  $column = "nome";
  $value  = htmlspecialchars(stripslashes(trim($_POST[$column])));

  $error = $validate->nome($value);
} elseif (isset($_POST["cnpj"])) {
  $column = "cnpj";
  $value  = htmlspecialchars(stripslashes(trim($_POST[$column])));

  $error = $validate->cnpj($value);
} elseif (isset($_POST["e-mail"])) {
  $column = "e-mail";
  $value  = filter_var($_POST[$column], FILTER_SANITIZE_EMAIL);

  $error = $validate->email($value);
} elseif (isset($_POST["telefone"])) {
  $column = "telefone";
  $value  = htmlspecialchars(stripslashes(trim($_POST[$column])));

  $error = $validate->telefone($value);
} elseif (isset($_POST["status"])) {
  $column = "status";
  $value  = htmlspecialchars(stripslashes(trim($_POST[$column])));

  $error = $validate->status($value);
} else {
  $error = "Algo deu errado...";
}

$_SESSION["error"] = $error;

// Update
// ---------------------------------------------------------------------

if (empty($error)) {
  $_SESSION["status"] = update("fornecedor", "id_fornecedor", $id, [$column => $value]);
}

// ---------------------------------------------------------------------

header("Location: /fornecedor?id=$id");
