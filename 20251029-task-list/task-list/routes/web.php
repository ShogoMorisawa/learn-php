<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Hello World';
});

Route::get('/users', function (){
    return 'Users page';
});

Route::get('/shogo', function(){
    return 'Shogo page';
});

Route::get('/users/{name}', function($name){
    return 'Hello' .' '. $name;
});

Route::fallback(function(){
    return '404 Not Found';
});