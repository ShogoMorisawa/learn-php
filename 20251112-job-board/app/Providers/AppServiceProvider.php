<?php

namespace App\Providers;

use App\Models\Job;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::bind('my_job', function (string $value) {
            return Job::withTrashed()->findOrFail($value);
        });
    }
}
