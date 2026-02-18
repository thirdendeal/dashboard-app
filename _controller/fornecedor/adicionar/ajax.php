<?php

require $_SERVER['DOCUMENT_ROOT'] . "/_model/entity/fornecedor/validate.php";

// ---------------------------------------------------------------------

$validate = new \Fornecedor\Validate();

$id = $_POST["id"];
$value = $_POST["value"];

switch ($id) {
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
}
