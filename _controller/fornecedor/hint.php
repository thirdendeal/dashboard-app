<?php

require $_SERVER["DOCUMENT_ROOT"] . "/_model/entity/fornecedor/validate.php";

// Escape
// ---------------------------------------------------------------------

$field = htmlspecialchars(stripslashes(trim($_POST["field"])));

if ($field == "e-mail") {
  $value = filter_var($_POST["value"], FILTER_SANITIZE_EMAIL);
} else {
  $value = htmlspecialchars(stripslashes(trim($_POST["value"])));
}

// Validate and respond
// ---------------------------------------------------------------------

$validate = new \Fornecedor\Validate();

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
