<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
        'role'=>\Spatie\Permission\Middleware\RoleMiddleware::class, //Cek apakah user punya role tertentu
        'permission'=>\Spatie\Permission\Middleware\PermissionMiddleware::class, //Cek apakah user punya permission tertentu.
        'role_or_permission'=>\Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class, //User boleh lanjut kalau punya role atau permission tertentu.
        'check_user_role'=>\App\Http\Middleware\check_user_role::class, //ngecek kondisi role user lebih spesifik
    ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
