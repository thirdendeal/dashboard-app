<aside class="aside">
  <h2 class="logotype">Burguer Burguer</h2>

  <?php
  $a  = $currentTab == 1 ? " tab__link--current"  : "";
  $b  = $currentTab == 2 ? " tab__link--current"  : "";
  $c  = $currentTab == 3 ? " tab__link--current"  : "";
  ?>

  <nav>
    <ul class="tabs">
      <li class="tab__item"><a href="/" class="tab__link<?= $a ?>">Dashboard</a></li>
      <li class="tab__item"><a href="/fornecedores/" class="tab__link<?= $b ?>">Fornecedores</a></li>
      <li class="tab__item"><a href="/produtos/" class="tab__link<?= $c ?>">Produtos</a></li>
    </ul>
  </nav>
</aside>
