<?php

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

$_SESSION["fields"] = $fields;

// Validate
// ---------------------------------------------------------------------

$validate = new \Produto\Validate();

$errors = [
  "nome" => $validate->nome($fields["nome"]),
  "descrição" => $validate->desc($fields["descrição"]),
  "código" => $validate->code($fields["código"])
];

$_SESSION["errors"] = $errors;

// Insert
// ---------------------------------------------------------------------

if (empty(array_filter($errors))) {
  $produto_id = insert(["dashboard_app.produto", $fields]);

  $_SESSION["status"] = $produto_id;

  // Insert relationships
  // -------------------------------------------------------------------

  if ($produto_id) {
    $match_ids = select_from("id_fornecedor", "dashboard_app.fornecedor")
      ->fetchAll(PDO::FETCH_COLUMN, 0);

    $fornecedor_ids = [];

    foreach ($match_ids as $match_id) {
      if (isset($_POST["fornecedor_$match_id"]))
        $fornecedor_ids[] = $match_id;
    }

    foreach ($fornecedor_ids as $fornecedor_id) {
      $status = insert([
        "dashboard_app.produto_fornecedor",
        ["id_produto" => $produto_id, "id_fornecedor" => $fornecedor_id]
      ]);

      if ($status === false)
        $_SESSION["status"] = false;
    }

  }
}

// ---------------------------------------------------------------------

$_SESSION["submitted"] = true;

// ---------------------------------------------------------------------

header("Location: /adicionar-produto/");
