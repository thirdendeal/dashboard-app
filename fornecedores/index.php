<?php
require $_SERVER['DOCUMENT_ROOT'] . "/_model/database/pdo/get-rows.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <?php
  $title = "Fornecedores";
  include $_SERVER['DOCUMENT_ROOT'] . "/_view/includes/head.php";
  ?>
</head>

<body class="body">
  <?php
  $currentTab = 2;
  include $_SERVER['DOCUMENT_ROOT'] . "/_view/includes/aside.php";
  ?>

  <main class="main">
    <div class="container">
      <h1>Fornecedores</h1>
      <br>

      <a href="/adicionar-fornecedor/" class="green-button">Adicionar Fornecedor</a>
      <br>

      <?php
      list($headers, $rows) = get_rows("fornecedor");

      if ($headers) {
      ?>
        <table>
          <thead>
            <tr>
              <?php
              foreach ($headers as $header) {
                if ($header == "id_fornecedor")
                  $header = "ID";

                if ($header == "cnpj")
                  $header = "CNPJ";

                echo "<th>$header</th>";
              }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row = $rows->fetch(PDO::FETCH_ASSOC)) {
              $id = $row["id_fornecedor"];

              echo "<tr class=\"link-row\" data-href=\"/fornecedor?id=$id\">";
              foreach ($row as $key => $value) {
                if ($key == "status") {
                  $value = $value ? "ATIVO" : "INATIVO";
                  $class = $value ? "td-active" : "td-inactive";

                  echo "<td class=\"$class\">$value</td>";
                } else {
                  echo "<td>$value</td>";
                }
              }
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      <?php
      } else {
      ?>
        <div class="empty-view">
          Nenhum fornecedor encontrado :(
        </div>
      <?php
      }
      ?>
    </div>
  </main>

  <script src="/_view/assets/js/jquery-4.0.0.min.js"></script>

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
