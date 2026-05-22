<?php

namespace Produto;

class Validate
{
  function nome($nome)
  {
    $length = strlen($nome);

    if ($length == 0) {
      return "Nome do Produto não pode estar vazio.";
    }

    if ($length > 255) {
      return "Nome do Produto não pode ultrapassar 255 caracteres.";
    }
  }

  function desc($desc)
  {
    $length = strlen($desc);

    if ($length > 255) {
      return "Descrição não pode ultrapassar 511 caracteres.";
    }
  }

  function code($code)
  {
    $length = strlen($code);

    if ($length > 255) {
      return "Código não pode ultrapassar 255 caracteres.";
    }
  }

  function status($status)
  {
    $status = (int) $status;

    if (($status != 0) && ($status != 1)) {
      return "Status inválido.";
    }
  }
}
