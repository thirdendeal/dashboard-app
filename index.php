<?php

session_start();

// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_view/helpers/consume-session.php";

// ---------------------------------------------------------------------

$session = consume_session(
  "connect",
  "connect_submit",
  "setup",
  "setup_submit",
  "drop",
  "drop_submit",
  "populate",
  "populate_submit"
);

?>

<!DOCTYPE html>
<html lang="pt-BR">

  <head>
    <?php
    $head_title = "Dashboard";
    include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/head.php";
    ?>
  </head>

  <body class="body">
    <?php
    $aside_current_tab = 1;
    include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/aside.php";
    ?>

    <main class="main">
      <div class="container">
        <h1>Dashboard</h1>
        <br>

        <p>Bem-vinda, equipe Burguer Burguer!</p>
      </div>
    </main>
  </body>

</html>
