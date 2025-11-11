<?php

use App\Livewire\CreatePoll;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('create-poll');
});

Route::get('/create-poll', CreatePoll::class)->name('create-poll');
