<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Adicionar Fornecedor - Burguer Burguer</title>

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
      <h1>Adicionar Fornecedor</h1>
      <br>

      <form action="">
        <label for="nome">
          Nome do Fornecedor
          <input class="textbox" type="text" name="nome" id="nome" />
        </label>

        <label for="cnpj">
          CNPJ
          <input class="textbox" type="text" name="cnpj" id="cnpj" />
        </label>

        <label for="email">
          E-Mail
          <input class="textbox" type="email" name="email" id="email" />
        </label>

        <label for="telefone">
          Telefone
          <input class="textbox" type="tel" name="telefone" id="telefone" />
        </label>

        <br>

        <input class="green-button" type="submit" value="Registrar Fornecedor" />
      </form>
    </div>
  </main>
</body>

</html>
