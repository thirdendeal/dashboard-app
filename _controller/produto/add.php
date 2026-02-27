<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/count-rows.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/insert.php";

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
  // Add `produto`

  list($status, $produto) = insert("produto", $fields);

  $_SESSION["status"] = $status;

  // Link `produto` to `fornecedor`

  list($_, $count) = count_rows("fornecedor", "id_fornecedor");
  $n = $count->fetchColumn();

  $fornecedores = [];

  for ($i = 1; $i <= $n; $i++) {
    if (isset($_POST["fornecedor_$i"])) {
      array_push($fornecedores, $i);
    }
  }

  foreach ($fornecedores as $fornecedor) {
    insert("produto_fornecedor", ["id_produto" => $produto, "id_fornecedor" => $fornecedor]);
  }
}

// ---------------------------------------------------------------------

$_SESSION["submitted"] = true;

// ---------------------------------------------------------------------

header("Location: /adicionar-produto/");
