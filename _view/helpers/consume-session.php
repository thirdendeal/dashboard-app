<?php

function consume_session(...$session_variables) {
  $assoc_array = [];

  foreach ($session_variables as $key) {
    $assoc_array[$key] = $_SESSION[$key] ?? "";

    unset($_SESSION[$key]);
  }

  return $assoc_array;
}
