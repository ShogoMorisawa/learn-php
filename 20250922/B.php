<?php

$input = trim(file_get_contents("php://stdin"));
$lines = explode("\n", $input);

[$a, $b] = array_map('intval', explode(" ", $lines[0]));

if (($a * $b) % 2 === 0) {
    echo "Even";
} else {
    echo "Odd";
}
