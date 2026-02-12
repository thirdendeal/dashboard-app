<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Fornecedores - Burguer Burguer</title>

  <link rel="stylesheet" href="/css/partials/minireset.min.css">
  <link rel="stylesheet" href="/css/partials/normalize.css">

  <link rel="stylesheet" href="/css/layouts/default.css">
</head>

<body class="body">

  <?php
  $currentTab = 2;
  include $_SERVER['DOCUMENT_ROOT'] . "/include/aside.php";
  ?>

  <main class="main">
    <div class="container">
      <h1>Fornecedores</h1>
      <br>

      <a href="/adicionar-fornecedor/" class="green-button">Adicionar Fornecedor</a>
      <br>

      <div class="empty-table-view">
        Nenhum fornecedor encontrado :(
      </div>
    </div>
  </main>
</body>

</html>
