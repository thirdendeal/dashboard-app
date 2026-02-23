<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/update.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/entity/fornecedor/validate.php";

// Parse
// ---------------------------------------------------------------------

// Query

parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY), $query);

// Field

if (isset($_POST["nome"])) {
  $field = "nome";
} elseif(isset($_POST["cnpj"])) {
  $field = "cnpj";
} elseif(isset($_POST["e-mail"])) {
  $field = "e-mail";
} elseif(isset($_POST["telefone"])) {
  $field = "telefone";
} elseif(isset($_POST["status"])) {
  $field = "status";
} else {
  $field = "";
}

// Escape
// ---------------------------------------------------------------------

// Identifier

$id = htmlspecialchars(stripslashes(trim($query["id"])));

// Value

if ($field == "e-mail") {
  $value = filter_var($_POST[$field], FILTER_SANITIZE_EMAIL);
} else {
  $value = htmlspecialchars(stripslashes(trim($_POST[$field])));
}

// Validate
// ---------------------------------------------------------------------

$validate = new \Fornecedor\Validate();

switch ($field) {
  case "nome":
    $error = $validate->nome($value);
    break;
  case "cnpj":
    $error = $validate->cnpj($value);
    break;
  case "e-mail":
    $error = $validate->email($value);
    break;
  case "telefone":
    $error = $validate->telefone($value);
    break;
  case "status":
    $error = $validate->status($value);
    break;
  default:
    $error = "Algo deu errado na atualização...";
}

$_SESSION["error"] = $error;

// Update
// ---------------------------------------------------------------------

if (empty($error)) {
  $_SESSION["status"] = update(
    "fornecedor", "id_fornecedor", $id, [$field => $value]
  );
}

// ---------------------------------------------------------------------

$_SESSION["submitted"] = true;

// ---------------------------------------------------------------------

header("Location: /fornecedor?id=$id");
