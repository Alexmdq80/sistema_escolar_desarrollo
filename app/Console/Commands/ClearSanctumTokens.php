<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Sanctum\PersonalAccessToken; // Asegúrate de importar el modelo de Sanctum

class ClearSanctumTokens extends Command
{
    protected $signature = 'sanctum:clear-tokens';
    protected $description = 'Clears all existing personal access tokens.';

    public function handle()
    {
        PersonalAccessToken::query()->truncate(); // Esto vacía la tabla de forma eficiente
        // O si quieres ser más específico (ej. por fecha)
        // PersonalAccessToken::query()->where('created_at', '<', now())->delete();

        $this->info('All Sanctum personal access tokens have been cleared.');
        return 0;
    }
}