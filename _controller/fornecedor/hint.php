<?php

require $_SERVER['DOCUMENT_ROOT'] . "/_model/entity/fornecedor/validate.php";

// Escape
// ---------------------------------------------------------------------

$validate = new \Fornecedor\Validate();

$field = htmlspecialchars(stripslashes(trim($_POST["field"])));

if ($field == "e-mail") {
  $value = filter_var($_POST["value"], FILTER_SANITIZE_EMAIL);
} else {
  $value = htmlspecialchars(stripslashes(trim($_POST["value"])));
}

// ---------------------------------------------------------------------

switch ($field) {
  case "nome":
    echo $validate->nome($value);
    break;
  case "cnpj":
    echo $validate->cnpj($value);
    break;
  case "e-mail":
    echo $validate->email($value);
    break;
  case "telefone":
    echo $validate->telefone($value);
    break;
  case "status":
    echo $validate->status($value);
    break;
}
