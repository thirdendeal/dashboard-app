<?php

// `Adicionar Fornecedor`
// ---------------------------------------------------------------------

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_/view/helpers/consume-session.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_/view/helpers/include-with.php";

// ---------------------------------------------------------------------

$add_f = consume_session("add_f");
?>

<?php
include_with("default", ["title" => "Adicionar Fornecedor", "tab" => 2]);
?>

<main class="main">
  <div class="container">
    <h1>Adicionar Fornecedor</h1>
    <br>

    <form action="/_/controller/fornecedor/add.php" method="post">
      <label for="nome">
        Nome do Fornecedor
        <input class="textbox" type="text" name="nome" id="nome" value="<?= $add_f["fields"]["nome"] ?? "" ?>" oninput="getHint(this.id, this.value)" />
        <span class="error"><?= $add_f["errors"]["nome"] ?? "" ?></span>
      </label>

      <label for="e-mail">
        E-Mail
        <input class="textbox" type="email" name="e-mail" id="e-mail" value="<?= $add_f["fields"]["e-mail"] ?? "" ?>" oninput="getHint(this.id, this.value)" />
        <span class="error"><?= $add_f["errors"]["e-mail"] ?? "" ?></span>
      </label>

      <label for="telefone">
        Telefone
        <input class="textbox" type="tel" name="telefone" id="telefone" value="<?= $add_f["fields"]["telefone"] ?? "" ?>" oninput="getHint(this.id, this.value)" />
        <span class="error"><?= $add_f["errors"]["telefone"] ?? "" ?></span>
      </label>

      <label for="cnpj">
        CNPJ
        <input class="textbox" type="text" name="cnpj" id="cnpj" value="<?= $add_f["fields"]["cnpj"] ?? "" ?>" oninput="getHint(this.id, this.value)" />
        <span class="error"><?= $add_f["errors"]["cnpj"] ?? "" ?></span>
      </label>

      <br>

      <input class="button button--green full-width" type="submit" value="Registrar Fornecedor" />
    </form>

    <?php if ($add_f["submitted"] ?? false) { ?>
      <?php if ($add_f["success"]) { ?>
        <div class="toast--success">
          Registro feito com sucesso!
          <a class="toast-link" href="/fornecedores/">Visualizar</a>
        </div>
      <?php } else { ?>
        <div class="toast--failure">
          Algo deu errado...
        </div>
      <?php } ?>
    <?php } ?>
  </div>
</main>

<script src="/_/view/vendor/jquery-v4.0.0.min.js"></script>

<script src="/_/view/assets/js/get-hint.js"></script>

<script>
  const getHint = makeGetHint("/_/controller/fornecedor/hint.php");
</script>

<?php
include_with("default", ["close" => true]);
?>
