<?php
require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/get-rows.php";

list($rows_success, $rows) = get_rows("fornecedor");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <?php
  $head_title = "Fornecedores";
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
      <h1>Fornecedores</h1>
      <br>

      <a href="/adicionar-fornecedor/" class="green-button">Adicionar Fornecedor</a>
      <br>

      <?php if ($rows_success) { ?>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>CNPJ</th>
              <th>E-Mail</th>
              <th>Telefone</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $rows->fetch(PDO::FETCH_ASSOC)) { ?>
              <tr class="link-row" data-href="/fornecedor?id=<?= $row["id_fornecedor"] ?>">
                <td><?= $row["id_fornecedor"] ?></td>
                <td><?= $row["nome"] ?></td>
                <td><?= $row["cnpj"] ?></td>
                <td><?= $row["e-mail"] ?></td>
                <td><?= $row["telefone"] ?></td>
                <td class="<?php echo $row['status'] ? 'green' : 'red' ?>">
                  <?php echo $row["status"] ? "ATIVO" : "INATIVO" ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } else { ?>
        <div class="empty-view">
          Nenhum fornecedor encontrado :(
        </div>
      <?php } ?>
    </div>
  </main>

  <script src="/_view/vendor/jquery-v4.0.0.min.js"></script>

  <script>
    $(document).ready(function() {
      $(".link-row").hover(function() {
        $(this).children().each(function() {
          $(this).css("background-color", "blanchedalmond");
        });
      }, function() {
        $(this).children().each(function() {
          $(this).removeAttr('style');
        });
      });

      $(".link-row").click(function() {
        window.location = $(this).data("href");
      });
    });
  </script>
</body>

</html>
