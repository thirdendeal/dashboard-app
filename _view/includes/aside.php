<aside class="aside">
  <h2 class="logotype">Burguer Burguer</h2>

  <?php
  $a  = $aside_current_tab == 1 ? " tab__link--current" : "";
  $b  = $aside_current_tab == 2 ? " tab__link--current" : "";
  $c  = $aside_current_tab == 3 ? " tab__link--current" : "";
  $d  = $aside_current_tab == 4 ? " tab__link--current" : "";
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
