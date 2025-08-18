<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
     {
      DB::table('escuela_nivel')
            ->select('id','id_escuela', 'id_nivel', 'id_modalidad')
            ->distinct()
            ->chunkById(1000, function ($old_data) {
                $new_records = [];

                foreach ($old_data as $record) {
                    $modalidad_nivel_record = DB::table('modalidad_nivel')
                        ->where('modalidad_id', $record->id_modalidad)
                        ->where('nivel_id', $record->id_nivel)
                        ->first();

                    if ($modalidad_nivel_record) {
                        $new_records[] = [
                            'escuela_id' => $record->id_escuela,
                            'modalidad_nivel_id' => $modalidad_nivel_record->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }

                if (!empty($new_records)) {
                    DB::table('escuela_modalidad_nivel')->insert($new_records);
                }
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ELIMNARLO MANUALMENTE
        // Revert the data migration by truncating the new table
       //  DB::table('escuela_modalidad_nivel')->truncate();
    }
};
