<?php

$str = trim(file_get_contents("php://stdin"));

$map = [];
for ($i = 97; $i < 123; $i++) {
    $map[chr($i)] = 0;
}

foreach (str_split($str) as $s) {
    $map[$s]++;
}

foreach ($map as $key => $value) {
    if ($value === 0) {
        echo $key;
        exit;
    }
}
