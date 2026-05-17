<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/select-from-where.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_view/helpers/consume-session.php";

// ---------------------------------------------------------------------

$add_p = consume_session("add_p");

?>

<!DOCTYPE html>
<html lang="pt-BR">

  <head>
    <?php
    $head_title = "Adicionar Produto";
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
        <h1>Adicionar Produto</h1>
        <br>

        <form action="/_controller/produto/add.php" method="post">
          <label for="nome">
            Nome do Produto
            <input class="textbox" type="text" name="nome" id="nome" value="<?= $add_p["fields"]["nome"] ?? "" ?>" oninput="getHint(this.id, this.value)" />
            <span class="error"><?= $add_p["errors"]["nome"] ?? "" ?></span>
          </label>

          <label for="descrição">
            Descrição
            <textarea class="textbox-area" name="descrição" id="descrição" rows="5" cols="30" oninput="getHint(this.id, this.value)" /><?= $add_p["fields"]["descrição"] ?? "" ?></textarea>
            <span class="error"><?= $add_p["errors"]["descrição"] ?? "" ?></span>
          </label>

          <label for="código">
            Código
            <input class="textbox" type="text" name="código" id="código" value="<?= $add_p["fields"]["código"] ?? "" ?>" oninput="getHint(this.id, this.value)" />
            <span class="error"><?= $add_p["errors"]["código"] ?? "" ?></span>
          </label>

          <br>

          <span class="label">Fornecedores</span>

          <?php
          $table_rows = select_from_where("*", "dashboard_app.fornecedor", ["status = ?", [1]]);

          $table = "fornecedor";
          $table_pairs = [
            "nome" => "Nome",
            "e-mail" => "E-Mail",
            "telefone" => "Telefone",
            "cnpj" => "CNPJ"
          ];

          $table_checkbox = true;

          include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/table.php";
          ?>

          <br>

          <input class="button button--green full-width" type="submit" value="Registrar Produto" />
        </form>

        <?php if ($add_p["submitted"] ?? false) { ?>
          <?php if ($add_p["success"]) { ?>
            <div class="toast--success">
              Registro feito com sucesso!
              <a class="toast-link" href="/produtos/">Visualizar</a>
            </div>
          <?php } else { ?>
            <div class="toast--failure">
              Algo deu errado...
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </main>

    <script src="/_view/vendor/jquery-v4.0.0.min.js"></script>

    <script src="/_view/assets/js/checkbox-table.js"></script>
    <script src="/_view/assets/js/get-hint.js"></script>

    <script>
      const getHint = makeGetHint("/_controller/produto/hint.php");
    </script>
  </body>

</html>
