<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/delete-where.php";

// Parse
// ---------------------------------------------------------------------

parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY), $query);

// Escape
// ---------------------------------------------------------------------

$fornecedor_id = htmlspecialchars(stripslashes(trim($query["id"])));

// Remove
// ---------------------------------------------------------------------

$pf_deletion = delete_where(
  "dashboard_app.produto_fornecedor pf",
  ["pf.id_fornecedor = ?", [$fornecedor_id]]
);

$f_deletion = delete_where(
  "dashboard_app.fornecedor f",
  ["f.id_fornecedor = ?", [$fornecedor_id]]
);

// ---------------------------------------------------------------------

$_SESSION["status"] = $pf_deletion && $f_deletion;
$_SESSION["submitted"] = true;

// ---------------------------------------------------------------------

header("Location: /fornecedores/");
