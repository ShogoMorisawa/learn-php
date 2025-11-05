<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    redirect()->route('books.index');
});

Route::resource('books', BookController::class);
