<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
     protected $commands = [
        // Aquí debes agregar la clase de tu comando
        \app\Console\Commands\GenerateUsuarioUuids::class,
        \app\Console\Commands\ClearSanctumTokens::class,
        \app\Console\Commands\PopulateInscripcionUuids::class,
        \app\Console\Commands\ActualizarInscripcionUuids::class,
        \app\Console\Commands\GenerarHistorialUuid::class,
        \app\Console\Commands\GenerarHistorialUuidCierreBaja::class,
        \app\Console\Commands\UuidHistorialCausaPase::class,
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
