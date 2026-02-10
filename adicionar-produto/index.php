<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Adicionar Produto - Burguer Burguer</title>

  <link rel="stylesheet" href="/css/partials/minireset.min.css">
  <link rel="stylesheet" href="/css/partials/normalize.css">

  <link rel="stylesheet" href="/css/layouts/default.css">
</head>

<body>

  <?php
  $currentTab = 3;
  include $_SERVER['DOCUMENT_ROOT'] . "/include/aside.php";
  ?>

  <main>
    <h1>Adicionar Produto</h1>
    <br>

    <form action="">
      <label for="nome">
        Nome do Produto
        <input class="textbox" type="text" name="nome" id="nome" />
      </label>

      <label for="descricao">
        Descrição
        <textarea class="textbox-area" name="descricao" id="descricao" rows="5" cols="30"></textarea>
      </label>

      <label for="codigo">
        Código
        <input class="textbox" type="text" name="codigo" id="codigo" />
      </label>

      <br>

      <input class="green-button" type="submit" value="Registrar Produto" />
    </form>
  </main>
</body>

</html>
