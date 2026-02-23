<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/get-row.php";

// Get row
// ---------------------------------------------------------------------

if (empty($_GET["id"])) {
  header("Location: /fornecedores/");

  exit();
}

list($row_success, $row) = get_row(
  "fornecedor",
  "id_fornecedor",
  htmlspecialchars(stripslashes(trim($_GET["id"])))
);

if ($row_success) {
  $fornecedor = $row->fetch(PDO::FETCH_ASSOC);
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
  $head_title = "Fornecedor";
  include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/head.php";
  ?>
</head>

<body class="body">
  <?php
  $aside_current_tab = 2;
  include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/aside.php";
  ?>

  <main class="main">
    <div class="container">
      <?php if ($fornecedor) { ?>
        <h1><?= $fornecedor["nome"] ?> – Fornecedor</h1>
        <br>

        <ul class="list">
          <li class="list__item">
            <h3 class="list__title">Nome</h3>

            <p class="list__p"><?= $fornecedor["nome"] ?></p>

            <form class="list__form" action="/_controller/fornecedor/edit.php" method="post">
              <label for="nome">
                <input class="list__input textbox" type="text" name="nome" id="nome" value="<?= $fornecedor["nome"] ?>" oninput="getHint(this.id, this.value)" />
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
            <h3 class="list__title">CNPJ</h3>

            <p class="list__p"><?= $fornecedor["cnpj"] ?></p>

            <form class="list__form" action="/_controller/fornecedor/edit.php" method="post">
              <label for="cnpj">
                <input class="list__input textbox" type="text" name="cnpj" id="cnpj" value="<?= $fornecedor["cnpj"] ?>" oninput="getHint(this.id, this.value)" />
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
            <h3 class="list__title">E-Mail</h3>

            <p class="list__p"><?= $fornecedor["e-mail"] ?></p>

            <form class="list__form" action="/_controller/fornecedor/edit.php" method="post">
              <label for="e-mail">
                <input class="list__input textbox" type="email" name="e-mail" id="e-mail" value="<?= $fornecedor["e-mail"] ?>" oninput="getHint(this.id, this.value)" />
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
            <h3 class="list__title">Telefone</h3>

            <p class="list__p"><?= $fornecedor["telefone"] ?></p>

            <form class="list__form" action="/_controller/fornecedor/edit.php" method="post">
              <label for="telefone">
                <input class="list__input textbox" type="tel" name="telefone" id="telefone" value="<?= $fornecedor["telefone"] ?>" oninput="getHint(this.id, this.value)" />
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

            <p class="list__p <?php echo $fornecedor['status'] ? 'green' : 'red' ?>">
              <?php echo $fornecedor["status"] ? "ATIVO" : "INATIVO" ?>
            </p>

            <form class="list__form" action="/_controller/fornecedor/edit.php" method="post">
              <label for="status">
                <input class="list__input textbox" type="text" name="status" id="status" value="<?= $fornecedor["status"] ?>" oninput="getHint(this.id, this.value)" />
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
      <?php } else { ?>
        <h1>Fornecedor</h1>
        <br>

        <div class="empty-view">
          Fornecedor não encontrado :(
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

  <script>
    $(document).ready(function() {
      // Initially hidden edit forms
      // ---------------------------------------------------------------

      $(".list__form").hide();

      // Show an edit form
      // ---------------------------------------------------------------

      $(".list__edit").click(function() {
        const form = $(this).prev();
        const p = form.prev();

        p.hide();
        $(this).hide();

        form.show();
      });

      // Rollback to on hide
      // ---------------------------------------------------------------

      let initialEditValues = {};

      $(".list__input").each(function() {
        const id = $(this).attr('id');
        const value = $(this).val();

        initialEditValues[id] = value;
      })

      // Hide an edit form
      // ---------------------------------------------------------------

      $(".list__cancel").click(function() {
        const padlock = $(this).parent();
        const form = padlock.parent();
        const p = form.prev();
        const edit = form.next();
        const input = form.find(".list__input");
        const id = input.attr('id');

        input.val(initialEditValues[id]); // rollback

        form.hide();

        p.show();
        edit.show();
      });
    });

    // -----------------------------------------------------------------

    const getHint = makeGetHint("/_controller/fornecedor/hint.php");
  </script>
</body>

</html>
