<?php

// Add `Produto`
// ---------------------------------------------------------------------
//
// From: /adicionar-produto/
// To:   /adicionar-produto/

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/insert.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/select-from.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/entity/produto/validate.php";

// Escape
// ---------------------------------------------------------------------

$fields = [
  "nome" => htmlspecialchars(stripslashes(trim($_POST["nome"]))),
  "descrição" => htmlspecialchars(stripslashes(trim($_POST["descrição"]))),
  "código" => htmlspecialchars(stripslashes(trim($_POST["código"])))
];

// Validate
// ---------------------------------------------------------------------

$validate = new \Produto\Validate();

$errors = [
  "nome" => $validate->nome($fields["nome"]),
  "descrição" => $validate->desc($fields["descrição"]),
  "código" => $validate->code($fields["código"])
];

// Insert
// ---------------------------------------------------------------------

$success = null;

if (empty(array_filter($errors))) {
  // `Produto`

  $p_id = insert(["dashboard_app.produto", $fields]);
  $success = ($p_id !== false);

  if ($p_id) {
    // `Produto-Fornecedor`

    $match_ids = select_from("id_fornecedor", "dashboard_app.fornecedor")
      ->fetchAll(PDO::FETCH_COLUMN, 0);

    $f_ids = [];

    foreach ($match_ids as $match_id) {
      if (isset($_POST["fornecedor_$match_id"]))
        $f_ids[] = $match_id;
    }

    foreach ($f_ids as $f_id) {
      $last_insert = insert([
        "dashboard_app.produto_fornecedor",
        ["id_produto" => $p_id, "id_fornecedor" => $f_id]
      ]);

      $success = $success && ($last_insert !== false);
    }
  }
}

// ---------------------------------------------------------------------

$_SESSION["add_p"] = [
  "submitted" => true,
  "success" => $success,
  "fields" => $success ?: $fields,
  "errors" => $errors
];

// ---------------------------------------------------------------------

header("Location: /adicionar-produto/");
