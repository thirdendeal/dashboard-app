<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Adicionar Produto - Burguer Burguer</title>

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
    </div>
  </main>
</body>

</html>
