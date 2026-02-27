<?php

$table_fields ??= [];
$table_checkbox ??= false;

$table_default_headers = [
  "id_fornecedor" => "ID",
  "nome" => "Nome",
  "e-mail" => "E-Mail",
  "telefone" => "Telefone",
  "cnpj" => "CNPJ",
  "status" => "Status"
];

function table_tr_data($id)
{
  global $table_checkbox;

  if ($table_checkbox) {
    return "data-checkbox=\"fornecedor_$id\"";
  } else {
    return "data-href=\"/fornecedor?id=$id\"";
  }
}

?>

<?php if ($table_rows->rowCount() > 0) { ?>
  <table>
    <thead>
      <tr>
        <?php if ($table_checkbox) { ?>
          <th></th>
        <?php } ?>

        <?php foreach ($table_fields as $field) { ?>
          <th><?php echo $table_headers[$field] ?? $table_default_headers[$field] ?></th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $table_rows->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr class="link-row" <?= table_tr_data($row["id_fornecedor"]) ?>>
          <?php if ($table_checkbox) { ?>
            <td>
              <label for="fornecedor_<?= $row["id_fornecedor"] ?>" style="margin: 0">
                <input type="checkbox" id="fornecedor_<?= $row["id_fornecedor"] ?>" name="fornecedor_<?= $row["id_fornecedor"] ?>" value="<?= $row["id_fornecedor"] ?>">
              </label>
            </td>
          <?php } ?>

          <?php foreach ($table_fields as $field) { ?>
            <?php if ($field == "status") { ?>
              <td class="<?php echo $row["status"] ? "green" : "red" ?>">
                <?php echo $row["status"] ? "ATIVO" : "INATIVO" ?>
              </td>
            <?php } else { ?>
              <td><?= $row[$field] ?></td>
            <?php } ?>
          <?php } ?>
        </tr>
      <?php } ?>
    </tbody>
  </table>
<?php } else { ?>
  <div class="empty-view">
    Nenhum fornecedor encontrado :(
  </div>
<?php } ?>
