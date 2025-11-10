<?php

use Illuminate\Foundation\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withSchedule(function (Illuminate\Console\Scheduling\Schedule $schedule): void {
        $schedule->command('app:send-event-reminders')->daily();
    })
    ->withMiddleware(/* ... */)
    ->withExceptions(/* ... */)
    ->create();
