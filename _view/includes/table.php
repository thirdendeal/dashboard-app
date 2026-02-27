<?php

$table ??= "";
$table_pairs ??= [];
$table_checkbox ??= false;

?>

<?php if ($table_rows->rowCount() > 0) { ?>
  <table>
    <thead>
      <tr>
        <?php if ($table_checkbox) { ?>
          <th></th>
        <?php } ?>

        <?php foreach ($table_pairs as $_ => $header) { ?>
          <th><?= $header ?></th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $table_rows->fetch(PDO::FETCH_ASSOC)) { ?>
        <?php $id = $row["id_$table"] ?>
        <?php $table_id = $table . "_" . $id ?>

        <tr class="link-row" <?= $table_checkbox ? "data-checkbox=\"$table_id\"" : "data-href=\"/$table?id=$id\"" ?>>
          <?php if ($table_checkbox) { ?>
            <td>
              <label for="<?= $table_id ?>" style="margin: 0">
                <input type="checkbox" id="<?= $table_id ?>" name="<?= $table_id ?>" value="<?= $id ?>">
              </label>
            </td>
          <?php } ?>

          <?php foreach ($table_pairs as $field => $_) { ?>
            <?php if ($field == "status") { ?>
              <td class="<?php echo $row["status"] ? "green" : "red" ?>">
                <?php echo $row["status"] ? "ATIVO" : "INATIVO" ?>
              </td>
            <?php } elseif ($field == "descrição") { ?>
              <td class="<?php echo $row["descrição"] ? "" : "gray" ?>">
                <?php echo $row["descrição"] ? $row["descrição"] : "(Nenhuma)" ?>
              </td>
            <?php } elseif ($field == "código") { ?>
              <td class="<?php echo $row["código"] ? "" : "gray" ?>">
                <?php echo $row["código"] ? $row["código"] : "(Nenhum)" ?>
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
