<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        channels: __DIR__ . '/../routes/channels.php',
        health: '/up',
        then: function () {

            Route::middleware('web')
                ->namespace('App\Http\Controllers\Admin')
                ->group(base_path('routes/admin/web.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'localization' => \App\Http\Middleware\Localization::class,
            'can_create_branch' => \App\Http\Middleware\CanCreateBranch::class,
            'can_create_admin' => \App\Http\Middleware\CanCreateAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (TokenMismatchException $e, $request) {

            return redirect()->route('login');

        });

    })->create();
