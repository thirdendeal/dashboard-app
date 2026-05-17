<?php

// `Produtos`
// ---------------------------------------------------------------------

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/repository.php";

require $_SERVER["DOCUMENT_ROOT"] . "/_view/helpers/consume-session.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_view/helpers/include-with.php";

// ---------------------------------------------------------------------

$remove_p = consume_session("remove_p");
?>

<?php
include_with("default", ["title" => "Produtos", "tab" => 3]);
?>

<main class="main">
  <div class="container">
    <h1>Produtos</h1>
    <br>

    <a href="/adicionar-produto/">
      <div class="button button--green full-width">
        Adicionar Produto
      </div>
    </a>

    <br>

    <?php
    try {
      // Connect
      require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo.php"; // throws on error
    } catch (Exception $e) {
      ?>
      <div class="empty-view">
        Falha na conexão!
      </div>
      <?php
    }

    try {
      // Use database
      $table_rows = Repository::query("produto/p-count-f.sql");

      $table = "produto";
      $table_pairs = [
        "nome" => "Nome",
        "descrição" => "Descrição",
        "código" => "Código",
        "fornecedores" => "Fornecedores",
        "status" => "Status",
      ];

      include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/table.php";
    } catch (Exception $e) {
      ?>
      <div class="empty-view">
        Banco de Dados não encontrado...
      </div>
      <?php
    }
    ?>

    <?php if ($remove_p["submitted"] ?? false) { ?>
      <?php if ($remove_p["success"]) { ?>
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
