<?php

$input = trim(file_get_contents("php://stdin"));
$lines = explode("\n", $input);

$a = intval($lines[0]);
[$b, $c] = array_map('intval', explode(" ", $lines[1]));
$s = trim($lines[2]);

echo $a + $b + $c . ' ' . $s . "\n";