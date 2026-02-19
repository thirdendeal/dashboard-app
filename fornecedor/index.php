<?php

if (!isset($_GET["id"])) {
  header("Location: /fornecedores");
  exit();
}

require $_SERVER['DOCUMENT_ROOT'] . "/_model/database/get-row.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <?php
  $title = "Fornecedor";
  include $_SERVER['DOCUMENT_ROOT'] . "/_view/includes/head.php";
  ?>
</head>

<body class="body">
  <?php
  $currentTab = 2;
  include $_SERVER['DOCUMENT_ROOT'] . "/_view/includes/aside.php";

  $id = htmlspecialchars(stripslashes(trim($_GET["id"])));

  $fornecedor = get_row("fornecedor", "id_fornecedor", $id);
  ?>

  <main class="main">
    <div class="container">
      <?php
      if ($fornecedor) {
      ?>
        <h1>Fornecedor <?= $fornecedor["id_fornecedor"] ?></h1>

        <br>

        <ul class="list">
          <li class="list__item">
            <h3 class="list__title">Nome do Fornecedor</h3>
            <p class="list__p"><?= $fornecedor["nome"] ?></p>
          </li>
          <li class="list__item">
            <h3 class="list__title">CNPJ</h3>
            <p class="list__p"><?= $fornecedor["cnpj"] ?></p>
          </li>
          <li class="list__item">
            <h3 class="list__title">E-Mail</h3>
            <p class="list__p"><?= $fornecedor["e-mail"] ?></p>
          </li>
          <li class="list__item">
            <h3 class="list__title">Telefone</h3>
            <p class="list__p"><?= $fornecedor["telefone"] ?></p>
          </li>
          <li class="list__item">
            <h3 class="list__title">Status</h3>
            <p class="list__p"><?php echo $fornecedor["status"] ? "ATIVO" : "INATIVO" ?></p>
          </li>
        </ul>
      <?php
      } else {
      ?>
        <h1>Fornecedor</h1>

        <br>

        <div class="empty-view">
          Fornecedor não encontrado :(
        </div>
      <?php
      }
      ?>
    </div>
  </main>
</body>

</html>
