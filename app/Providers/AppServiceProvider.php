<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password; // ¡Importa esta clase!

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
    // Define tus reglas de contraseña por defecto aquí
        Password::defaults(function () {
            $rule = Password::min(8)
                ->mixedCase()  // Requiere mayúsculas y minúsculas
                ->letters()    // Requiere al menos una letra
                ->numbers()    // Requiere al menos un número
                ->symbols();   // Requiere al menos un símbolo

            // Opcional: Solo si estás en producción, puedes añadir uncompromised()
            // para chequear si la contraseña ha sido comprometida en filtraciones.
            //if ($this->app->isProduction()) {
            //    $rule->uncompromised();
            //}

            return $rule;
        });
    }
}
