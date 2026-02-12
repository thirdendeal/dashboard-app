<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Produtos - Burguer Burguer</title>

  <link rel="stylesheet" href="/_view/assets/css/minireset.min.css">
  <link rel="stylesheet" href="/_view/assets/css/normalize.css">

  <link rel="stylesheet" href="/_view/assets/css/default.css">
</head>

<body class="body">

  <?php
  $currentTab = 3;
  include $_SERVER['DOCUMENT_ROOT'] . "/_view/includes/aside.php";
  ?>

  <main class="main">
    <div class="container">
      <h1>Produtos</h1>
      <br>

      <a href="/adicionar-produto/" class="green-button">Adicionar Produto</a>
      <br>

      <div class="empty-table-view">
        Nenhum produto encontrado :(
      </div>
    </div>
  </main>
</body>

</html>
