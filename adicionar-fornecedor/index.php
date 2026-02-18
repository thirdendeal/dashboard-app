<?php

session_start();

// Insert

$success = isset($_SESSION["status"]) && $_SESSION["status"];
$failure = !$success;

// Fields

if (isset($_SESSION["fields"]) && $failure) { // auto-fill on failure only
  $fields = $_SESSION["fields"];

  unset($_SESSION['fields']);
} else {
  $fields = [];

  $fields["nome"]     = "";
  $fields["cnpj"]     = "";
  $fields["e-mail"]   = "";
  $fields["telefone"] = "";
}

// Errors

if (isset($_SESSION["errors"])) {
  $errors = $_SESSION["errors"];

  unset($_SESSION['errors']);
} else {
  $errors = [];

  $errors["nome"]     = "";
  $errors["cnpj"]     = "";
  $errors["e-mail"]   = "";
  $errors["telefone"] = "";
}

// Status

if (isset($_SESSION["status"])) {
  if ($_SESSION["status"]) {
    $toast = "toast--success";
  } else {
    $toast = "toast--failure";
  }

  unset($_SESSION['fields']);
  unset($_SESSION['status']);
} else {
  $toast = "toast--hidden";
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Adicionar Fornecedor - Burguer Burguer</title>

  <link rel="stylesheet" href="/_view/assets/css/minireset.min.css">
  <link rel="stylesheet" href="/_view/assets/css/normalize.css">

  <link rel="stylesheet" href="/_view/assets/css/default.css">
</head>

<body class="body">

  <?php
  $currentTab = 2;
  include $_SERVER['DOCUMENT_ROOT'] . "/_view/includes/aside.php";
  ?>

  <main class="main">
    <div class="container">
      <h1>Adicionar Fornecedor</h1>
      <br>

      <form action="/_controller/fornecedor/adicionar/submit.php" method="post">
        <label for="nome">
          Nome do Fornecedor
          <input class="textbox" type="text" name="nome" id="nome" value="<?= $fields["nome"] ?>" oninput="ajaxField(this.id, this.value)" />
          <span class="error"><?= $errors["nome"] ?></span>
        </label>

        <label for="cnpj">
          CNPJ
          <input class="textbox" type="text" name="cnpj" id="cnpj" value="<?= $fields["cnpj"] ?>" oninput="ajaxField(this.id, this.value)" />
          <span class="error"><?= $errors["cnpj"] ?></span>
        </label>

        <label for="e-mail">
          E-Mail
          <input class="textbox" type="email" name="e-mail" id="e-mail" value="<?= $fields["e-mail"] ?>" oninput="ajaxField(this.id, this.value)" />
          <span class="error"><?= $errors["e-mail"] ?></span>
        </label>

        <label for="telefone">
          Telefone
          <input class="textbox" type="tel" name="telefone" id="telefone" value="<?= $fields["telefone"] ?>" oninput="ajaxField(this.id, this.value)" />
          <span class="error"><?= $errors["telefone"] ?></span>
        </label>

        <br>

        <input class="green-button" type="submit" value="Registrar Fornecedor" />
      </form>

      <div class="<?= $toast ?>"></div>
    </div>
  </main>

  <script src="/_view/assets/js/jquery-4.0.0.min.js"></script>
  <script src="/_view/assets/js/ajax.js"></script>

  <script>
    const ajaxField = ajax("/_controller/fornecedor/adicionar/ajax.php");
  </script>
</body>

</html>
