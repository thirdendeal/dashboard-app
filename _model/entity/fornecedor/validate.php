<?php

namespace Fornecedor;

class Validate
{
  function nome($nome)
  {
    // Fornecedor

    $length = strlen($nome);

    if ($length == 0) {
      return "Nome do Fornecedor não pode estar vazio.";
    }

    if ($length > 255) {
      return "Nome do Fornecedor não pode ultrapassar 255 caracteres.";
    }
  }

  function cnpj($cnpj)
  {
    // 00.000.000/0000-00

    $length = strlen($cnpj);

    if (($length < 14) || ($length > 18)) {
      return "CNPJ inválido.";
    }
  }

  function email($email)
  {
    // contato@fornecedor.com.br
    // a@b.ab

    $length = strlen($email);

    if ($length < 6) {
      return "E-mail inválido.";
    }

    if ($length > 255) {
      return "E-mail não pode ultrapassar 255 caracteres.";
    }
  }

  function telefone($telefone)
  {
    // +00 (00) 00000-0000

    $length = strlen($telefone);

    if (($length < 8) || ($length > 19)) {
      return "Telefone inválido.";
    }
  }
}
