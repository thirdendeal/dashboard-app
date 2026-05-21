<?php

// `Fornecedores`
// ---------------------------------------------------------------------

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/select-from.php";

require $_SERVER["DOCUMENT_ROOT"] . "/_view/helpers/consume-session.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_view/helpers/include-with.php";

// ---------------------------------------------------------------------

$remove_f = consume_session("remove_f");
?>

<?php
include_with("default", ["title" => "Fornecedores", "tab" => 2]);
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

    <?php if ($remove_f["submitted"] ?? false) { ?>
      <?php if ($remove_f["success"]) { ?>
        <div class="toast--success">
          Remoção feita com sucesso!
        </div>
      <?php } else { ?>
        <div class="toast--failure">
          Algo deu errado...
        </div>
      <?php } ?>
    <?php } ?>
  </div>
</main>

<script src="/_view/vendor/jquery-v4.0.0.min.js"></script>

<script src="/_view/assets/js/link-table.js"></script>

<?php
include_with("default", ["close" => true]);
?>
