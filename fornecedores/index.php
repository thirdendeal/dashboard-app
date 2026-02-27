<?php
require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/get-rows.php";
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

      <a href="/adicionar-fornecedor/" class="green-button">Adicionar Fornecedor</a>
      <br>

      <?php
      list($_, $table_rows) = get_rows("fornecedor");

      $table_fields = [
        "nome",
        "e-mail",
        "telefone",
        "cnpj",
        "status"
      ];

      include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/fornecedor/table.php";
      ?>
    </div>
  </main>

  <script src="/_view/vendor/jquery-v4.0.0.min.js"></script>

  <script src="/_view/assets/js/link-table.js"></script>
</body>

</html>
