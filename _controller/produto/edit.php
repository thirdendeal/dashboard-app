<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/delete-where.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/insert.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/repository.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/select-from.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/update-where.php";

require $_SERVER["DOCUMENT_ROOT"] . "/_model/entity/produto/validate.php";

// ---------------------------------------------------------------------

function accumulate_session($session_variable, $value)
{
  return isset($_SESSION[$session_variable]) ? $_SESSION[$session_variable] && $value : $value;
}

// Parse
// ---------------------------------------------------------------------

// Query

parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY), $query);

// Field

if (isset($_POST["nome"])) {
  $field = "nome";
} elseif (isset($_POST["descrição"])) {
  $field = "descrição";
} elseif (isset($_POST["código"])) {
  $field = "código";
} elseif (isset($_POST["telefone"])) {
  $field = "telefone";
} elseif (isset($_POST["status"])) {
  $field = "status";
} elseif (isset($_POST["checkbox-table"])) {
  $field = "checkbox-table";
}

// Escape
// ---------------------------------------------------------------------

$produto_id = htmlspecialchars(stripslashes(trim($query["id"])));

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
  case "checkbox-table":
    $error = "";
    break;
  default:
    $error = "Algo deu errado na atualização...";
}

$_SESSION["error"] = $error;

// Update
// ---------------------------------------------------------------------

if ($field != "checkbox-table" && empty($error)) {
  $_SESSION["status"] = update_where(
    ["dashboard_app.produto", [$field => $value]],
    ["id_produto = ?", [$produto_id]]
  );
}

// Update relationships
// ---------------------------------------------------------------------

if ($field == "checkbox-table") {
  $fornecedor_ids = select_from("id_fornecedor", "dashboard_app.fornecedor")
    ->fetchAll(PDO::FETCH_COLUMN, 0);

  $f_entries = Repository::prepare_execute("fornecedor/f-linked-to-p.sql", [$produto_id])
    ->fetchAll(PDO::FETCH_GROUP);

  foreach ($fornecedor_ids as $fornecedor_id) {
    $linked = $f_entries[$fornecedor_id][0]["linked"];

    if (isset($_POST["fornecedor_$fornecedor_id"])) {
      if ($linked) {
        continue;
      }

      $status = insert([
        "dashboard_app.produto_fornecedor",
        ["id_produto" => $produto_id, "id_fornecedor" => $fornecedor_id]
      ]);

      $_SESSION["status"] = accumulate_session("status", ($status !== false));
    } else {
      if (!$linked) {
        continue;
      }

      $status = delete_where(
        "dashboard_app.produto_fornecedor",
        ["id_fornecedor = ?", [$fornecedor_id]]
      );

      $_SESSION["status"] = accumulate_session("status", $status);
    }
  }
}

// ---------------------------------------------------------------------

$_SESSION["submitted"] = true;

// ---------------------------------------------------------------------

header("Location: /produto?id=$produto_id");
