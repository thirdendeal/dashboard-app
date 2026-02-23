<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <?php
  $head_title = "Produtos";
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
      <h1>Produtos</h1>
      <br>

      <a href="/adicionar-produto/" class="green-button">Adicionar Produto</a>
      <br>

      <div class="empty-view">
        Nenhum produto encontrado :(
      </div>
    </div>
  </main>
</body>

</html>
