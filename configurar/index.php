<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_view/helpers/consume-session.php";

// ---------------------------------------------------------------------

$session = consume_session(
  "connect", "connect_submit",
  "setup", "setup_submit",
  "drop", "drop_submit",
  "populate", "populate_submit"
);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <?php
  $head_title = "Configurar";
  include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/head.php";
  ?>
</head>

<body class="body">
  <?php
  $aside_current_tab = 0;
  include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/aside.php";
  ?>

  <main class="main">
    <div class="container">
      <h1>Configurar</h1>
      <br>

      <ul>
        <li>
          <form action="/_controller/configurar/connect.php" method="post">
            <input class="green-button left" type="submit" value="Testar Conexão">
          </form>

          <?php if ($session["connect_submit"]) { ?>
            <div class="<?= $session["connect"] ? "green" : "red" ?>">
              <?= $session["connect"] ? "> Conexão feita com sucesso." : "* Erro na conexão ao banco de dados." ?>
            </div>
          <?php } ?>

          <br>
        </li>
        <li>
          <form action="/_controller/configurar/setup.php" method="post">
            <input class="green-button left" type="submit" value="Setup">
          </form>

          <?php if ($session["setup_submit"]) { ?>
            <div class="<?= $session["setup"] ? "green" : "red" ?>">
              <?= $session["setup"] ? "> Setup feito com sucesso." : "* Erro no setup do banco de dados." ?>
            </div>
          <?php } ?>

          <br>
        </li>
        <li>
          <form action="/_controller/configurar/drop.php" method="post">
            <input class="green-button left" type="submit" value="Remover Banco de Dados">
          </form>

          <?php if ($session["drop_submit"]) { ?>
            <div class="<?= $session["drop"] ? "green" : "red" ?>">
              <?= $session["drop"] ? "> Remoção feita com sucesso." : "* Erro ao remover o banco de dados." ?>
            </div>
          <?php } ?>

          <br>
        </li>
        <li>
          <form action="/_controller/configurar/populate.php" method="post">
            <input class="green-button left" type="submit" value="Inserir Mockup">
          </form>

          <?php if ($session["populate_submit"]) { ?>
            <div class="<?= $session["populate"] ? "green" : "red" ?>">
              <?= $session["populate"] ? "> Inserção feita com sucesso." : "* Erro na inserção no banco de dados." ?>
            </div>
          <?php } ?>
        </li>
      </ul>
    </div>
  </main>
</body>

</html>
