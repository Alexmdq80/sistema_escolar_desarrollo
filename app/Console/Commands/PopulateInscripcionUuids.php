<?php

namespace App\Console\Commands;

use App\Models\Inscripcion;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class PopulateInscripcionUuids extends Command
{
    protected $signature = 'populate:inscripcion-uuids';
    protected $description = 'Populates the UUID column for existing Inscripcion records.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $this->info('Starting to populate UUIDs...');

        Inscripcion::chunk(1000, function ($inscripciones) {
            foreach ($inscripciones as $inscripcion) {
                if (is_null($inscripcion->uuid)) {
                    $inscripcion->uuid = Str::uuid();
                    $inscripcion->save();
                }
            }
        });

        $this->info('UUID population finished!');

        return Command::SUCCESS;
    }
}
