<?php

// `Configurar`
// ---------------------------------------------------------------------

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_view/helpers/consume-session.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_view/helpers/include-with.php";

// ---------------------------------------------------------------------

$connect = consume_session("connect");
$database = consume_session("database");
$setup = consume_session("setup");
$drop = consume_session("drop");
$populate = consume_session("populate");
?>

<?php
include_with("default", ["title" => "Configurar", "tab" => 4]);
?>

<main class="main">
  <div class="container">
    <h1>Configurar</h1>
    <br>

    <ul class="command-list">
      <li class="command-item">
        <form action="/_controller/configurar/connect.php" method="post">
          <input class="button button--green full-width left" type="submit" value="Verificar Conexão">
        </form>

        <?php if ($connect["submitted"] ?? false) { ?>
          <?php if ($connect["success"]) { ?>
            <div class="green">
              > Conexão feita com sucesso
            </div>
          <?php } else { ?>
            <div class="red">
              * Falha na conexão
            </div>
          <?php } ?>
        <?php } ?>
      </li>
      <li class="command-item">
        <form action="/_controller/configurar/database.php" method="post">
          <input class="button button--green full-width left" type="submit" value="Verificar Banco de Dados">
        </form>

        <?php if ($database["submitted"] ?? false) { ?>
          <?php if ($database["success"]) { ?>
            <div class="green">
              > Banco de Dados encontrado
            </div>
          <?php } else { ?>
            <?php if ($database["connect"]) { ?>
              <div class="red">
                * Banco de Dados não encontrado
              </div>
            <?php } else { ?>
              <div class="red">
                * Falha na conexão
              </div>
            <?php } ?>
          <?php } ?>
        <?php } ?>
      </li>
      <li class="command-item">
        <form action="/_controller/configurar/setup.php" method="post">
          <input class="button button--green full-width left" type="submit" value="Criar Banco de Dados">
        </form>

        <?php if ($setup["submitted"] ?? false) { ?>
          <?php if ($setup["success"]) { ?>
            <div class="green">
              > Criação feita com sucesso
            </div>
          <?php } else { ?>
            <div class="red">
              * Erro na criação do banco de dados
            </div>
          <?php } ?>
        <?php } ?>
      </li>
      <li class="command-item">
        <form action="/_controller/configurar/populate.php" method="post">
          <input class="button button--green full-width left" type="submit" value="Inserir Dados">
        </form>

        <?php if ($populate["submitted"] ?? false) { ?>
          <?php if ($populate["success"]) { ?>
            <div class="green">
              > Inserção feita com sucesso
            </div>
          <?php } else { ?>
            <div class="red">
              * Erro na inserção no banco de dados
            </div>
          <?php } ?>
        <?php } ?>

        <br>
      </li>

      <li class="command-item">
        <form action="/_controller/configurar/drop.php" method="post">
          <input class="button button--red full-width left" type="submit" value="Remover Banco de Dados">
        </form>

        <?php if ($drop["submitted"] ?? false) { ?>
          <?php if ($drop["success"]) { ?>
            <div class="red">
              > Remoção feita com sucesso
            </div>
          <?php } else { ?>
            <div class="yellow">
              * Erro ao remover o banco de dados
            </div>
          <?php } ?>
        <?php } ?>
      </li>
    </ul>
  </div>
</main>

<?php
include_with("default", ["close" => true]);
?>
