<?php

// Edit `Produto`
// ---------------------------------------------------------------------
//
// From: /produto?id=
// To:   /produto?id=

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/delete-where.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/insert.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/repository.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/select-from.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/update-where.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/entity/produto/validate.php";

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

$p_id = htmlspecialchars(stripslashes(trim($query["id"])));

$value = htmlspecialchars(stripslashes(trim($_POST[$field])));

// Validate
// ---------------------------------------------------------------------

$validate = new \Produto\Validate();

$error = null;

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
}

// Update
// ---------------------------------------------------------------------

// `Produto`

if ($field != "checkbox-table" && empty($error)) {
  $p_update_attempt = true;

  $p_update_success = update_where(
    ["dashboard_app.produto", [$field => $value]],
    ["id_produto = ?", [$p_id]]
  );
}

// `Produto-Fornecedor`

if ($field == "checkbox-table") {
  $pf_update_attempt = true;

  $f_ids = select_from("id_fornecedor", "dashboard_app.fornecedor")
    ->fetchAll(PDO::FETCH_COLUMN, 0);

  $f_entries = Repository::prepare_execute("fornecedor/f-linked-to-p.sql", [$p_id])
    ->fetchAll(PDO::FETCH_GROUP);

  foreach ($f_ids as $f_id) {
    $linked = $f_entries[$f_id][0]["linked"];

    if (isset($_POST["fornecedor_$f_id"])) {
      if ($linked) {
        continue;
      }

      $last_insert = insert([
        "dashboard_app.produto_fornecedor",
        ["id_produto" => $p_id, "id_fornecedor" => $f_id]
      ]);

      $pf_update_success = ($last_insert !== false);
    } else {
      if (!$linked) {
        continue;
      }

      $pf_update_success = delete_where(
        "dashboard_app.produto_fornecedor",
        ["id_fornecedor = ?", [$f_id]]
      );
    }
  }
}

// ---------------------------------------------------------------------

$success = null;

if ($p_update_attempt && $pf_update_attempt) {
  $success = $p_update_success && $pf_update_success;
} elseif ($p_update_attempt) {
  $success = $p_update_success;
} elseif ($pf_update_attempt) {
  $success = $pf_update_success;
}

// ---------------------------------------------------------------------

$_SESSION["edit_p"] = [
  "submitted" => true,
  "success" => $success,
  "error" => $error
];

// ---------------------------------------------------------------------

header("Location: /produto?id=$p_id");
