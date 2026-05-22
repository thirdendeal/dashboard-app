<?php

function inner_join($table, $joins)
{
  $cumulation = $table;

  foreach ($joins as $join_table => $condition) {
    $cumulation = "$cumulation INNER JOIN $join_table ON $condition";
  }

  return $cumulation;
}
