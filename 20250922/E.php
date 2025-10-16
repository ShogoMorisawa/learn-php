<?php

// $input = trim(file_get_contents("php://stdin"));
$input = "4
###.
..#.
..#.
..#.
...#
...#
###.
....";
$lines = explode("\n", $input);

$N = intval($lines[0]);
$S = array_map('str_split', array_slice($lines, 1, $N));
$T = array_map('str_split', array_slice($lines, $N + 1));

function rotate($grid)
{
    $res = array_fill(0, $N, array_fill(0, $N, '.'));
}
