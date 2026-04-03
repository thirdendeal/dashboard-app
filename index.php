<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_view/helpers/consume-session.php";

// ---------------------------------------------------------------------

$session = consume_session(
  "connect",
  "connect_submit",
  "setup",
  "setup_submit",
  "drop",
  "drop_submit",
  "populate",
  "populate_submit"
);

?>

<!DOCTYPE html>
<html lang="pt-BR">

  <head>
    <?php
    $head_title = "Dashboard";
    include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/head.php";
    ?>
  </head>

  <body class="body">
    <?php
    $aside_current_tab = 1;
    include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/aside.php";
    ?>

    <main class="main">
      <div class="container">
        <h1>Dashboard</h1>
        <br>

        <p>Bem-vinda, equipe Burguer Burguer!</p>
        <br>

        <ul class="command-list">
          <li class="command-item">
            <form action="/_controller/(root)/connect.php" method="post">
              <input class="button button--green full-width left" type="submit" value="Testar Conexão">
            </form>

            <?php if ($session["connect_submit"]) { ?>
              <div class="<?= $session["connect"] ? "green" : "red" ?>">
                <?= $session["connect"] ? "> Conexão feita com sucesso" : "* Erro na conexão ao banco de dados" ?>
              </div>
            <?php } ?>
          </li>
          <li class="command-item">
            <form action="/_controller/(root)/setup.php" method="post">
              <input class="button button--green full-width left" type="submit" value="Criar Banco de Dados">
            </form>

            <?php if ($session["setup_submit"]) { ?>
              <div class="<?= $session["setup"] ? "green" : "red" ?>">
                <?= $session["setup"] ? "> Criação feita com sucesso" : "* Erro na criação do banco de dados" ?>
              </div>
            <?php } ?>
          </li>
          <li class="command-item">
            <form action="/_controller/(root)/populate.php" method="post">
              <input class="button button--green full-width left" type="submit" value="Inserir Dados">
            </form>

            <?php if ($session["populate_submit"]) { ?>
              <div class="<?= $session["populate"] ? "green" : "red" ?>">
                <?= $session["populate"] ? "> Inserção feita com sucesso" : "* Erro na inserção no banco de dados" ?>
              </div>
            <?php } ?>

            <br>
          </li>

          <li class="command-item">
            <form action="/_controller/(root)/drop.php" method="post">
              <input class="button button--red full-width left" type="submit" value="Remover Banco de Dados">
            </form>

            <?php if ($session["drop_submit"]) { ?>
              <div class="<?= $session["drop"] ? "red" : "yellow" ?>"> <?= $session["drop"] ? "> Remoção feita com sucesso" : "* Erro ao remover o banco de dados" ?>
              </div>
            <?php } ?>
          </li>
        </ul>
      </div>
    </main>
  </body>

</html>
