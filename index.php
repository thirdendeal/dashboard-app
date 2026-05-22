<?php

// Dashboard
// ---------------------------------------------------------------------

require $_SERVER["DOCUMENT_ROOT"] . "/_/view/helpers/include-with.php";
?>

<?php
include_with("default", ["title" => "Dashboard", "tab" => 1]);
?>

<main class="main">
  <div class="container">
    <h1>Dashboard</h1>
    <br>

    <p>Bem-vinda, equipe Burguer Burguer!</p>
  </div>
</main>

<?php
include_with("default", ["close" => true]);
?>
