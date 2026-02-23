<?php

session_start();

// Submission
// ---------------------------------------------------------------------

$submitted = isset($_SESSION["submitted"]);

unset($_SESSION["submitted"]);

// Status
// ---------------------------------------------------------------------

$attempted = isset($_SESSION["status"]);
$inserted = $_SESSION["status"] ?? false;

unset($_SESSION["status"]);

// Fields
// ---------------------------------------------------------------------

// Auto-fill on failure only

$fields = [
  "nome"     => $inserted ? "" : ($_SESSION["fields"]["nome"] ?? ""),
  "cnpj"     => $inserted ? "" : ($_SESSION["fields"]["cnpj"] ?? ""),
  "e-mail"   => $inserted ? "" : ($_SESSION["fields"]["e-mail"] ?? ""),
  "telefone" => $inserted ? "" : ($_SESSION["fields"]["telefone"] ?? "")
];

unset($_SESSION["fields"]);

// Errors
// ---------------------------------------------------------------------

$errors = [
  "nome"     => $_SESSION["errors"]["nome"] ?? "",
  "cnpj"     => $_SESSION["errors"]["cnpj"] ?? "",
  "e-mail"   => $_SESSION["errors"]["e-mail"] ?? "",
  "telefone" => $_SESSION["errors"]["telefone"] ?? ""
];

unset($_SESSION["errors"]);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <?php
  $head_title = "Adicionar Fornecedor";
  include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/head.php";
  ?>
</head>

<body class="body">
  <?php
  $aside_current_tab = 2;
  include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/aside.php";
  ?>

  <main class="main">
    <div class="container">
      <h1>Adicionar Fornecedor</h1>
      <br>

      <form action="/_controller/fornecedor/add.php" method="post">
        <label for="nome">
          Nome do Fornecedor
          <input class="textbox" type="text" name="nome" id="nome" value="<?= $fields["nome"] ?>" oninput="getHint(this.id, this.value)" />
          <span class="error"><?= $errors["nome"] ?></span>
        </label>

        <label for="cnpj">
          CNPJ
          <input class="textbox" type="text" name="cnpj" id="cnpj" value="<?= $fields["cnpj"] ?>" oninput="getHint(this.id, this.value)" />
          <span class="error"><?= $errors["cnpj"] ?></span>
        </label>

        <label for="e-mail">
          E-Mail
          <input class="textbox" type="email" name="e-mail" id="e-mail" value="<?= $fields["e-mail"] ?>" oninput="getHint(this.id, this.value)" />
          <span class="error"><?= $errors["e-mail"] ?></span>
        </label>

        <label for="telefone">
          Telefone
          <input class="textbox" type="tel" name="telefone" id="telefone" value="<?= $fields["telefone"] ?>" oninput="getHint(this.id, this.value)" />
          <span class="error"><?= $errors["telefone"] ?></span>
        </label>

        <br>

        <input class="green-button" type="submit" value="Registrar Fornecedor" />
      </form>

      <?php if ($attempted) { ?>
        <?php if ($inserted) { ?>
          <div class="toast--success">Registro feito com sucesso! <a class="toast-link" href="/fornecedores">Vizualizar</a></div>
        <?php } else { ?>
          <div class="toast--failure">Algo deu errado no registro...</div>
        <?php } ?>
      <?php } ?>
    </div>
  </main>

  <script src="/_view/vendor/jquery-v4.0.0.min.js"></script>
  <script src="/_view/assets/js/get-hint.js"></script>

  <script>
    const getHint = makeGetHint("/_controller/fornecedor/hint.php");
  </script>
</body>

</html>
