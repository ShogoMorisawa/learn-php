<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

// 求人関連のルート
Route::redirect('/', '/jobs');
Route::resource('jobs', JobController::class)->only(['index', 'show']);

// 認証関連のルート
Route::get('login', fn () => to_route('auth.create'))->name('login');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');
Route::resource('auth', AuthController::class)->only(['create', 'store']);

// 求人申請関連のルート
Route::middleware('auth')->group(function () {
    Route::resource('job.applications', JobApplicationController::class)->only(['create', 'store']);
});
