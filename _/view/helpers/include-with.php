<?php

function include_with($include, $variables)
{
  extract($variables);

  include $_SERVER["DOCUMENT_ROOT"] . "/_/view/includes/$include.php";
}
