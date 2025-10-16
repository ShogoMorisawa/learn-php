<?php
// echo "Hello World";
// echo '<br>';

// $arr = [1,2,3,4,5];
// echo $arr[4];
// echo '<br>';

// print_r($arr);
// echo '<br>';

// function square($x){
//     return $x *$x;
// }
// echo square(5);

function one($n)
{
    return $n * 2;
}
echo one(3);

function two($a, $b)
{
    return $a + $b;
}
echo two(3, 5);

function three($n)
{
    if ($n % 2 === 0) {
        return "Even";
    } else {
        return "Odd";
    }
}
echo three(6);
