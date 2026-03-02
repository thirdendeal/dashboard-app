<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/count-all-rows.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/insert-into.php";

require $_SERVER["DOCUMENT_ROOT"] . "/_model/entity/produto/validate.php";

// Escape
// ---------------------------------------------------------------------

$fields = [
  "nome"      => htmlspecialchars(stripslashes(trim($_POST["nome"]))),
  "descrição" => htmlspecialchars(stripslashes(trim($_POST["descrição"]))),
  "código"    => htmlspecialchars(stripslashes(trim($_POST["código"])))
];

$_SESSION["fields"] = $fields;

// Validate
// ---------------------------------------------------------------------

$validate = new \Produto\Validate();

$errors = [
  "nome"      => $validate->nome($fields["nome"]),
  "descrição" => $validate->desc($fields["descrição"]),
  "código"    => $validate->code($fields["código"])
];

$_SESSION["errors"] = $errors;

// Insert
// ---------------------------------------------------------------------

if (empty(array_filter($errors))) {
  $produto_id = insert_into("produto", $fields);

  $_SESSION["status"] = $produto_id;

  // Link

  if ($produto_id) {
    $fornecedor_count = count_all_rows("fornecedor");

    if ($fornecedor_count) {
      $fornecedor_ids = [];

      for ($id = 1; $id <= $fornecedor_count; $id++) {
        if (isset($_POST["fornecedor_$id"]))
          $fornecedor_ids[] = $id;
      }

      foreach ($fornecedor_ids as $fornecedor_id) {
        $produto_fornecedor_id = insert_into("produto_fornecedor", ["id_produto" => $produto_id, "id_fornecedor" => $fornecedor_id]);

        $_SESSION["status"] = $_SESSION["status"] && $produto_fornecedor_id;
      }
    }
  }
}

// ---------------------------------------------------------------------

$_SESSION["submitted"] = true;

// ---------------------------------------------------------------------

header("Location: /adicionar-produto/");
