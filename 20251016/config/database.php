<?php

$host = '127.0.0.1';
$user = 'root';
$password = '';
$db_name = 'login_app';

$connection = mysqli_connect($host, $user, $password, $db_name);

if (!$connection) {
    die('Database connection failed: ' . mysqli_connect_error());
} else {
    echo 'hello db!';
}
