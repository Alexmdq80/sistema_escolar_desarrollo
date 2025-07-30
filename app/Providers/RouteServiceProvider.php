<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api/v1')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

  // Limitador para el cambio de email
        RateLimiter::for('change-email', function (Request $request) {
            return Limit::perMinutes(60, 5) // 5 intentos cada 60 minutos
                        ->by($request->user()?->id ?: $request->ip())
                        ->response(function (Request $request, array $headers) {
                            return response()->json([
                                'message' => 'Has intentado cambiar tu email demasiadas veces. Por favor, espera una hora antes de intentarlo de nuevo.',
                                'retry_after' => $headers['Retry-After'] ?? null,
                            ], Response::HTTP_TOO_MANY_REQUESTS, $headers); // Usar constante 429
                        });
        });

        // Limitador para el cambio de contraseña
        RateLimiter::for('change-password', function (Request $request) {
            return Limit::perMinutes(60, 5) // 5 intentos cada 60 minutos
                        ->by($request->user()?->id ?: $request->ip())
                        ->response(function (Request $request, array $headers) {
                            return response()->json([
                                'message' => 'Has intentado cambiar tu contraseña demasiadas veces. Por favor, espera una hora antes de intentarlo de nuevo.',
                                'retry_after' => $headers['Retry-After'] ?? null,
                            ], Response::HTTP_TOO_MANY_REQUESTS, $headers); // Usar constante 429
                        });
        });

        // Limitador para el reenvío de verificación de email
        RateLimiter::for('resend-verification', function (Request $request) {
            return Limit::perMinutes(30, 3) // 3 intentos cada 30 minutos
                        ->by($request->user()?->id ?: $request->ip())
                        ->response(function (Request $request, array $headers) {
                            return response()->json([
                                'message' => 'Has solicitado el reenvío de verificación de email demasiadas veces. Por favor, espera 30 minutos antes de intentarlo de nuevo.',
                                'retry_after' => $headers['Retry-After'] ?? null,
                            ], Response::HTTP_TOO_MANY_REQUESTS, $headers); // Usar constante 429
                        });
        });

    }
}
