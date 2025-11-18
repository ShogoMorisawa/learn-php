<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MyJobApplicationController;
use App\Http\Controllers\MyJobController;
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

// マイ求人申請関連のルート
Route::middleware('auth')->group(function () {
    Route::resource('my-job-applications', MyJobApplicationController::class)->only([
        'index',
        'destroy',
    ]);
});

// 雇用主関連のルート
Route::middleware('auth')->group(function () {
    Route::resource('employer', EmployerController::class)->only(['create', 'store']);
});

// マイ求人関連のルート
Route::middleware('auth')->group(function () {
    Route::resource('my-job', MyJobController::class);
});
