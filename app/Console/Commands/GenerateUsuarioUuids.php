<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UsuarioOld as Usuario;
use Illuminate\Support\Str;

class GenerateUsuarioUuids extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'usuario:generate-uuids'; // Este es el comando que ejecutas

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates UUIDs for existing Usuarios.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Generating UUIDs for existing Usuarios...');

        $modelo = new Usuario();
        $modelo->setTable('usuario');

       /* $modelo::all()->each(function ($usuario) {
            if (empty($usuario->uuid)) { // Verifica si el UUID ya existe antes de generarlo
                $usuario->uuid = (string) Str::uuid();
                $usuario->save();
            }
        });*/
        $modelo->all()->each(function ($usuario) {
            if (empty($usuario->uuid)) {
                $usuario->uuid = (string) Str::uuid();
                $usuario->save();
            }
        });

        $this->info('UUIDs generated for all usuarios.');

        return 0;
    }
}
