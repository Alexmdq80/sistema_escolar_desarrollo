<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Str;

class GenerateUserUuids extends Command
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
    protected $description = 'Generates UUIDs for existing users.';

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
        $this->info('Generating UUIDs for existing users...');

        User::all()->each(function ($user) {
            if (empty($user->uuid)) { // Verifica si el UUID ya existe antes de generarlo
                $user->uuid = (string) Str::uuid();
                $user->save();
            }
        });

        $this->info('UUIDs generated for all users.');

        return 0;
    }
}