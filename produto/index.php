<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/find-rows.php";
require $_SERVER["DOCUMENT_ROOT"] . "/_model/entity/produto_fornecedor/join-by-produto.php";

// Redirect malformed
// ---------------------------------------------------------------------

if (empty($_GET["id"])) {
  header("Location: /produtos/");

  exit();
}

$id = htmlspecialchars(stripslashes(trim($_GET["id"])));

// Get `produto`
// ---------------------------------------------------------------------

list($row_success, $row) = find_rows("produto", "id_produto", $id);

if ($row_success) {
  $produto = $row->fetch(PDO::FETCH_ASSOC);
}

// Update
// ---------------------------------------------------------------------

// Submission

$submitted = isset($_SESSION["submitted"]);

unset($_SESSION["submitted"]);

// Status

$attempted = isset($_SESSION["status"]);
$updated = $_SESSION["status"] ?? false;

unset($_SESSION['status']);

// Error

$error = $_SESSION['error'] ?? "";

unset($_SESSION['error']);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <?php
  $head_title = "Produto";
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
      <?php if ($produto) { ?>
        <h1><?= $produto["nome"] ?> – Produto</h1>
        <br>

        <ul class="list">
          <li class="list__item">
            <h3 class="list__title">Nome</h3>

            <p class="list__p"><?= $produto["nome"] ?></p>

            <form class="list__form" action="/_controller/produto/edit.php" method="post">
              <label for="nome">
                <input class="list__input textbox" type="text" name="nome" id="nome" value="<?= $produto["nome"] ?>" oninput="getHint(this.id, this.value)" />
                <span class="list__error error"></span>
              </label>

              <div class="list__form__padlock">
                <input class="list__submit" type="submit" value="Atualizar" />
                <button type="button" class="list__cancel">Cancelar</button>
              </div>
            </form>

            <button class="list__edit">
              <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z" fill="#ffffff" />
              </svg>
            </button>
          </li>
          <li class="list__item">
            <h3 class="list__title">Descrição</h3>

            <p class="list__p <?php echo $produto["descrição"] ? "" : "gray" ?>">
              <?php echo $produto["descrição"] ? $produto["descrição"] : "(Nenhum)" ?>
            </p>

            <form class="list__form" action="/_controller/produto/edit.php" method="post">
              <label for="descrição">
                <textarea class="textbox-area" name="descrição" id="descrição" rows="5" cols="30" oninput="getHint(this.id, this.value)" /><?= $produto["descrição"] ?></textarea>
                <span class="list__error error"></span>
              </label>

              <div class="list__form__padlock">
                <input class="list__submit" type="submit" value="Atualizar" />
                <button type="button" class="list__cancel">Cancelar</button>
              </div>
            </form>

            <button class="list__edit">
              <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z" fill="#ffffff" />
              </svg>
            </button>
          </li>
          <li class="list__item">
            <h3 class="list__title">Código</h3>

            <p class="list__p <?php echo $produto["código"] ? "" : "gray" ?>">
              <?php echo $produto["código"] ? $produto["código"] : "(Nenhum)" ?>
            </p>

            <form class="list__form" action="/_controller/produto/edit.php" method="post">
              <label for="código">
                <input class="list__input textbox" type="tel" name="código" id="código" value="<?= $produto["código"] ?>" oninput="getHint(this.id, this.value)" />
                <span class="list__error error"></span>
              </label>

              <div class="list__form__padlock">
                <input class="list__submit" type="submit" value="Atualizar" />
                <button type="button" class="list__cancel">Cancelar</button>
              </div>
            </form>

            <button class="list__edit">
              <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z" fill="#ffffff" />
              </svg>
            </button>
          </li>
          <li class="list__item">
            <h3 class="list__title">Status</h3>

            <p class="list__p <?php echo $produto['status'] ? 'green' : 'red' ?>">
              <?php echo $produto["status"] ? "ATIVO" : "INATIVO" ?>
            </p>

            <form class="list__form" action="/_controller/produto/edit.php" method="post">
              <label for="status">
                <input class="list__input textbox" type="text" name="status" id="status" value="<?= $produto["status"] ?>" oninput="getHint(this.id, this.value)" />
                <span class="list__error error"></span>
              </label>

              <div class="list__form__padlock">
                <input class="list__submit" type="submit" value="Atualizar" />
                <button type="button" class="list__cancel">Cancelar</button>
              </div>
            </form>

            <button class="list__edit">
              <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z" fill="#ffffff" />
              </svg>
            </button>
          </li>
        </ul>

        <br>
        <span class="label">Fornecedores</span>

        <?php

        // Get `produto_fornecedor`
        // ---------------------------------------------------------------------

        list($_, $table_rows) = join_by_produto(
          $id,
          "fornecedor.id_fornecedor",
          "fornecedor.nome",
          "fornecedor.cnpj",
          "fornecedor.`e-mail`",
          "fornecedor.telefone"
        );

        $table_fields = [
          "nome",
          "e-mail"
        ];

        include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/fornecedor/table.php";
        ?>
      <?php } else { ?>
        <h1>Produto</h1>
        <br>

        <div class="empty-view">
          Produto não encontrado :(
        </div>
      <?php } ?>

      <?php if ($submitted) { ?>
        <?php if ($updated) { ?>
          <div class="toast--success">Atualização feita com sucesso!</div>
        <?php } else { ?>
          <div class="toast--failure"><?= $error ?></div>
        <?php } ?>
      <?php } ?>
    </div>
  </main>

  <script src="/_view/vendor/jquery-v4.0.0.min.js"></script>

  <script src="/_view/assets/js/get-hint.js"></script>
  <script src="/_view/assets/js/link-table.js"></script>
  <script src="/_view/assets/js/toggle-edit.js"></script>

  <script>
    const getHint = makeGetHint("/_controller/produto/hint.php");
  </script>
</body>

</html>
