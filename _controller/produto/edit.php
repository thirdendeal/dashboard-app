<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/update.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/entity/produto/validate.php";

// Parse
// ---------------------------------------------------------------------

// Query

parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY), $query);

// Field

if (isset($_POST["nome"])) {
  $field = "nome";
} elseif(isset($_POST["descrição"])) {
  $field = "descrição";
} elseif(isset($_POST["código"])) {
  $field = "código";
} elseif(isset($_POST["telefone"])) {
  $field = "telefone";
} elseif(isset($_POST["status"])) {
  $field = "status";
} else {
  $field = "";
}

// Escape
// ---------------------------------------------------------------------

$id    = htmlspecialchars(stripslashes(trim($query["id"])));
$value = htmlspecialchars(stripslashes(trim($_POST[$field])));

// Validate
// ---------------------------------------------------------------------

$validate = new \Produto\Validate();

switch ($field) {
  case "nome":
    $error = $validate->nome($value);
    break;
  case "descrição":
    $error = $validate->desc($value);
    break;
  case "código":
    $error = $validate->code($value);
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
    "produto", "id_produto", $id, [$field => $value]
  );
}

// ---------------------------------------------------------------------

$_SESSION["submitted"] = true;

// ---------------------------------------------------------------------

header("Location: /produto?id=$id");
