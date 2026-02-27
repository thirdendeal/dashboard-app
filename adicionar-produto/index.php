<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/find-rows.php";

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
  "nome"      => $inserted ? "" : ($_SESSION["fields"]["nome"] ?? ""),
  "descrição" => $inserted ? "" : ($_SESSION["fields"]["descrição"] ?? ""),
  "código"    => $inserted ? "" : ($_SESSION["fields"]["código"] ?? "")
];

unset($_SESSION["fields"]);

// Errors
// ---------------------------------------------------------------------

$errors = [
  "nome"      => $_SESSION["errors"]["nome"] ?? "",
  "descrição" => $_SESSION["errors"]["descrição"] ?? "",
  "código"    => $_SESSION["errors"]["código"] ?? ""
];

unset($_SESSION["errors"]);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <?php
  $head_title = "Adicionar Produto";
  include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/head.php";
  ?>
</head>

<body class="body">
  <?php
  $aside_current_tab = 3;
  include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/aside.php";
  ?>

  <main class="main">
    <div class="container">
      <h1>Adicionar Produto</h1>
      <br>

      <form action="/_controller/produto/add.php" method="post">
        <label for="nome">
          Nome do Produto
          <input class="textbox" type="text" name="nome" id="nome" value="<?= $fields["nome"] ?>" oninput="getHint(this.id, this.value)" />
          <span class="error"><?= $errors["nome"] ?></span>
        </label>

        <label for="descrição">
          Descrição
          <textarea class="textbox-area" name="descrição" id="descrição" rows="5" cols="30" oninput="getHint(this.id, this.value)" /><?= $fields["descrição"] ?></textarea>
          <span class="error"><?= $errors["descrição"] ?></span>
        </label>

        <label for="código">
          Código
          <input class="textbox" type="text" name="código" id="código" value="<?= $fields["código"] ?>" oninput="getHint(this.id, this.value)" />
          <span class="error"><?= $errors["código"] ?></span>
        </label>

        <br>

        <span class="label">Fornecedores</span>

        <?php
        list($_, $table_rows) = find_rows("fornecedor", "status", 1);

        $table_checkbox = true;

        $table_fields = [
          "nome",
          "e-mail",
          "telefone",
          "cnpj"
        ];

        include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/fornecedor/table.php";
        ?>

        <br>

        <input class="green-button" type="submit" value="Registrar Produto" />
      </form>

      <?php if ($attempted) { ?>
        <?php if ($inserted) { ?>
          <div class="toast--success">Registro feito com sucesso! <a class="toast-link" href="/produtos/">Visualizar</a></div>
        <?php } else { ?>
          <div class="toast--failure">Algo deu errado no registro...</div>
        <?php } ?>
      <?php } ?>
    </div>
  </main>

  <script src="/_view/vendor/jquery-v4.0.0.min.js"></script>

  <script src="/_view/assets/js/checkbox-table.js"></script>
  <script src="/_view/assets/js/get-hint.js"></script>

  <script>
    const getHint = makeGetHint("/_controller/produto/hint.php");
  </script>
</body>

</html>
