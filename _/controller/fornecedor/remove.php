<?php

// Remove `Fornecedor`
// ---------------------------------------------------------------------
//
// From: /fornecedor?id=
// To:   /fornecedores/

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_/model/database/pdo/delete-where.php";

// Parse
// ---------------------------------------------------------------------

parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY), $query);

// Escape
// ---------------------------------------------------------------------

$f_id = htmlspecialchars(stripslashes(trim($query["id"])));

// Remove
// ---------------------------------------------------------------------

$pf_deletion = delete_where(
  "dashboard_app.produto_fornecedor pf",
  ["pf.id_fornecedor = ?", [$f_id]]
);

$f_deletion = delete_where(
  "dashboard_app.fornecedor f",
  ["f.id_fornecedor = ?", [$f_id]]
);

// ---------------------------------------------------------------------

$_SESSION["remove_f"] = [
  "submitted" => true,
  "success" => $pf_deletion && $f_deletion
];

// ---------------------------------------------------------------------

header("Location: /fornecedores/");
