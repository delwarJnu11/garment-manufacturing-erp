
<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EmployeeMiddleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors; // Add this line
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::prefix('vue')->name('vue.')->group(base_path('routes/vue.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([

            'admin' => AdminMiddleware::class,
            'admin' => AdminMiddleware::class,
            'employee' => EmployeeMiddleware::class,

        ]);


        $middleware->append(HandleCors::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle unauthenticated exception globally
        $exceptions->renderable(function (AuthenticationException $e, $request) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. Token is invalid or missing.',
            ], 401);
        });
    })->create();
