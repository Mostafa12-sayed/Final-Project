<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Modules\Dashboard\app\Http\Middleware\CheckLoginUserNormal;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append( \App\Http\Middleware\PreventBackHistory::class);

        $middleware->alias([
            'auth.guset.admin' => \App\Http\Middleware\PreventBackHistory::class,
            'checkUserNormal'=>CheckLoginUserNormal::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
