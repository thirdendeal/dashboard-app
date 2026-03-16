<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/select-from.php";

// Delete
// ---------------------------------------------------------------------

// Submission

$submitted = isset($_SESSION["submitted"]);

unset($_SESSION["submitted"]);

// Status

$attempted = isset($_SESSION["status"]);
$deleted = $_SESSION["status"] ?? false;

unset($_SESSION['status']);

// Error

$error = $_SESSION['error'] ?? "";

unset($_SESSION['error']);

?>

<!DOCTYPE html>
<html lang="pt-BR">

  <head>
    <?php
    $head_title = "Fornecedores";
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
        <h1>Fornecedores</h1>
        <br>

        <a href="/adicionar-fornecedor/">
          <div class="button button--green full-width">
            Adicionar Fornecedor
          </div>
        </a>

        <br>

        <?php
        $table_rows = select_from("*", "dashboard_app.fornecedor");

        $table = "fornecedor";
        $table_pairs = [
          "nome" => "Nome",
          "e-mail" => "E-Mail",
          "telefone" => "Telefone",
          "cnpj" => "CNPJ",
          "status" => "Status",
        ];

        include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/table.php";
        ?>

        <?php if ($submitted) { ?>
          <?php if ($deleted) { ?>
            <div class="toast--success">Remoção feita com sucesso!</div>
          <?php } else { ?>
            <div class="toast--failure"><?= $error ? $error : "Algo deu errado..." ?></div>
          <?php } ?>
        <?php } ?>
      </div>
    </main>

    <script src="/_view/vendor/jquery-v4.0.0.min.js"></script>

    <script src="/_view/assets/js/link-table.js"></script>
  </body>

</html>
