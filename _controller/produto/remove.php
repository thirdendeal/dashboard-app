<?php

// Remove `Produto`
// ---------------------------------------------------------------------
//
// From: /produto?id=
// To:   /produtos/

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/delete-where.php";

// ---------------------------------------------------------------------

parse_str(
  parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY),
  $query
);

$p_id = htmlspecialchars(stripslashes(trim($query["id"])));

// ---------------------------------------------------------------------

$pf_deletion = delete_where(
  "dashboard_app.produto_fornecedor pf",
  ["pf.id_produto = ?", [$p_id]]
);

$p_deletion = delete_where(
  "dashboard_app.produto p",
  ["p.id_produto = ?", [$p_id]]
);

// ---------------------------------------------------------------------

$_SESSION["remove_p"] = [
  "submitted" => true,
  "success" => $pf_deletion && $p_deletion
];

// ---------------------------------------------------------------------

header("Location: /produtos/");
