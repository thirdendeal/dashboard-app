<?php

// Default (Layout)
// ---------------------------------------------------------------------

$open = isset($close) ? !$close : true;
?>

<?php if ($open) { ?>
  <!DOCTYPE html>
  <html lang="pt-BR">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <title><?= $title ?> – <?= $suffix ?? "Burguer Burguer" ?></title>

      <link rel="stylesheet" href="/_view/vendor/minireset-v0.0.6.min.css">
      <link rel="stylesheet" href="/_view/vendor/normalize-v8.0.1.css">

      <link rel="stylesheet" href="/_view/assets/css/default.css">
    </head>

    <body class="body">
      <aside class="aside">
        <h2 class="logotype">Burguer Burguer</h2>

        <?php
        $a = $tab == 1 ? " tab__link--current" : "";
        $b = $tab == 2 ? " tab__link--current" : "";
        $c = $tab == 3 ? " tab__link--current" : "";
        $d = $tab == 4 ? " tab__link--current" : "";
        ?>

        <nav>
          <ul class="tabs">
            <li class="tab__item"><a href="/" class="tab__link<?= $a ?>">Dashboard</a></li>
            <li class="tab__item"><a href="/fornecedores/" class="tab__link<?= $b ?>">Fornecedores</a></li>
            <li class="tab__item"><a href="/produtos/" class="tab__link<?= $c ?>">Produtos</a></li>
            <li class="tab__item"><a href="/configurar/" class="tab__link<?= $d ?>">Configurar</a></li>
          </ul>
        </nav>
      </aside>

<?php } else { ?>
    </body>

  </html>
<?php } ?>
