<?php

// Hint `Produto`
// ---------------------------------------------------------------------
//
// XHR: /produto?id=
// XHR: /adicionar-produto/

require $_SERVER["DOCUMENT_ROOT"] . "/_/model/entity/produto/validate.php";

// Escape
// ---------------------------------------------------------------------

$field = htmlspecialchars(stripslashes(trim($_POST["field"])));
$value = htmlspecialchars(stripslashes(trim($_POST["value"])));

// Validate and respond
// ---------------------------------------------------------------------

$validate = new \Produto\Validate();

switch ($field) {
  case "nome":
    echo $validate->nome($value);
    break;
  case "descrição":
    echo $validate->desc($value);
    break;
  case "código":
    echo $validate->code($value);
    break;
}
