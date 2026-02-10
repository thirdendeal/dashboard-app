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

<body>

  <?php
  $currentTab = 2;
  include $_SERVER['DOCUMENT_ROOT'] . "/include/aside.php";
  ?>

  <main>
    <h1>Fornecedores</h1>
    <br>

    <a href="/novo-fornecedor/" class="add-button">Adicionar Fornecedor</a>
    <br>

    <div class="empty-table-view">
      Nenhum fornecedor encontrado :(
    </div>
  </main>
</body>

</html>
