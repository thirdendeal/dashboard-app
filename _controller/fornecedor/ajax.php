<?php

require $_SERVER['DOCUMENT_ROOT'] . "/_model/entity/fornecedor/validate.php";

// ---------------------------------------------------------------------

$validate = new \Fornecedor\Validate();

$id = htmlspecialchars(stripslashes(trim($_POST["id"])));
$value = htmlspecialchars(stripslashes(trim($_POST["value"])));

switch ($id) {
  case "nome":
    echo $validate->nome($value);
    break;
  case "cnpj":
    echo $validate->cnpj($value);
    break;
  case "e-mail":
    $value = filter_var($_POST["value"], FILTER_SANITIZE_EMAIL);

    echo $validate->email($value);
    break;
  case "telefone":
    echo $validate->telefone($value);
    break;
  case "status":
    echo $validate->status($value);
    break;
}
