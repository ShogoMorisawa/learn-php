<?php

$input = trim(file_get_contents("php://stdin"));
$arr = str_split($input);
$count = 0;

foreach ($arr as $a) {
    if (intval($a) === 1) {
        $count++;
    }
}

echo $count;
