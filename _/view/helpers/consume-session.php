<?php

// Consume Session
// ---------------------------------------------------------------------

function consume_session($key)
{
  $copy = unserialize(serialize($_SESSION[$key] ?? null));

  unset($_SESSION[$key]);

  return $copy;
}
