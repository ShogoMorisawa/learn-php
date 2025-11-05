<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\RateLimiter;

Route::get('/', function () {
    redirect()->route('books.index');
});

Route::resource('books', BookController::class)->only(['index', 'show']);

Route::resource('books.reviews', ReviewController::class)->scoped(['review' => 'book'])->only(['create', 'store'])->middleware('throttle:reviews');
