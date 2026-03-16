<?php

$table ??= "";
$table_pairs ??= [];
$table_checkbox ??= false;
$table_linked ??= false;

?>

<?php if ($table_rows && $table_rows->rowCount() > 0) { ?>
  <table class="<?= $table_checkbox ? "checkbox-table" : "link-table" ?>">
    <thead>
      <tr>
        <?php if ($table_checkbox) { ?>
          <th style="padding-left: 0.75rem;">■</th>
        <?php } ?>

        <?php foreach ($table_pairs as $_ => $header) { ?>
          <th><?= $header ?></th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $table_rows->fetch(PDO::FETCH_ASSOC)) { ?>
        <?php
        $row_linked = $table_linked && $row["linked"];

        if ($table_linked && !$row["linked"] && !$row["status"]) { // not linked and inactive
          continue;
        }

        $row_id = $row["id_$table"];
        $table_id = $table . "_" . $row_id;

        $link_inactive = isset($row["status"]) && !$row["status"] ? "gray" : "";
        $link_selected = $row_linked ? "link-row--selected" : "";
        $tr_data = $table_checkbox ? "data-checkbox=\"$table_id\"" : "data-href=\"/$table?id=$row_id\"";
        ?>

        <tr class="link-row <?= $link_inactive ?> <?= $link_selected ?>" <?= $tr_data ?>>
          <?php if ($table_checkbox) { ?>
            <td>
              <label for="<?= $table_id ?>" style="margin: 0">
                <input type="checkbox" id="<?= $table_id ?>" name="<?= $table_id ?>" value="<?= $row_id ?>" <?= $row_linked ? "checked" : "" ?>>
              </label>
            </td>
          <?php } ?>

          <?php foreach ($table_pairs as $field => $_) { ?>
            <?php if ($field == "status") { ?>
              <td class="<?= $row["status"] ? "green" : "red" ?>">
                <?= $row["status"] ? "ATIVO" : "INATIVO" ?>
              </td>
            <?php } elseif ($field == "descrição") { ?>
              <td class="<?= $row["descrição"] ? "" : "gray" ?>">
                <?= $row["descrição"] ? $row["descrição"] : "(Nenhuma)" ?>
              </td>
            <?php } elseif ($field == "código") { ?>
              <td class="<?= $row["código"] ? "" : "gray" ?>">
                <?= $row["código"] ? $row["código"] : "(Nenhum)" ?>
              </td>
            <?php } elseif ($field == "fornecedores") { ?>
              <td class="center">
                <?= $row["fornecedores"] ?>
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
    Nenhum <?= $table ?> encontrado :(
  </div>
<?php } ?>
