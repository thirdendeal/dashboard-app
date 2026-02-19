<?php
require $_SERVER['DOCUMENT_ROOT'] . "/_model/database/pdo.php";

require $_SERVER['DOCUMENT_ROOT'] . "/_model/database/get-table.php";
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
      list($headers, $rows) = get_table("fornecedor");

      if ($headers) {
      ?>
        <table>
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

          <?php
          while ($row = $rows->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
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
        </table>
      <?php
      } else {
      ?>
        <div class="empty-table-view">
          Nenhum fornecedor encontrado :(
        </div>
      <?php
      }
      ?>
    </div>
  </main>
</body>

</html>
