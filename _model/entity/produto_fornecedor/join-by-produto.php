<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php";

// ---------------------------------------------------------------------

function join_by_produto($pk, ...$columns) {
  global $pdo;

  $columns_string = implode(", ", $columns);

  $statement = $pdo->prepare("
    SELECT $columns_string
    FROM dashboard_app.produto_fornecedor
    INNER JOIN dashboard_app.produto
    ON dashboard_app.produto_fornecedor.id_produto = $pk
    INNER JOIN dashboard_app.fornecedor
    ON dashboard_app.produto_fornecedor.id_fornecedor = dashboard_app.fornecedor.id_fornecedor;
  ");

  $status = $statement->execute();

  return [$status, $statement];
}
