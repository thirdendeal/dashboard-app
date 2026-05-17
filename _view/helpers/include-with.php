<?php

function include_with($include, $variables)
{
  extract($variables);

  include $_SERVER["DOCUMENT_ROOT"] . "/_view/includes/$include.php";
}
