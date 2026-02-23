<?php
require $_SERVER["DOCUMENT_ROOT"] . "/_model/database/pdo/get-rows.php";

list($rows_success, $rows) = get_rows("produto");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <?php
  $head_title = "Produtos";
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
      <h1>Produtos</h1>
      <br>

      <a href="/adicionar-produto/" class="green-button">Adicionar Produto</a>
      <br>

      <?php if ($rows->rowCount() > 0) { ?>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Descrição</th>
              <th>Código</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $rows->fetch(PDO::FETCH_ASSOC)) { ?>
              <tr class="link-row" data-href="/produto?id=<?= $row["id_produto"] ?>">
                <td><?= $row["id_produto"] ?></td>
                <td><?= $row["nome"] ?></td>
                <td><?= $row["descrição"] ?></td>
                <td class="<?php echo $row["código"] ? "" : "gray" ?>">
                  <?php echo $row["código"] ? $row["código"] : "(Nenhum)" ?>
                </td>
                <td class="<?php echo $row['status'] ? 'green' : 'red' ?>">
                  <?php echo $row["status"] ? "ATIVO" : "INATIVO" ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } else { ?>
        <div class="empty-view">
          Nenhum produto encontrado :(
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
