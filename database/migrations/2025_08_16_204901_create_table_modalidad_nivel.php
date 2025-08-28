<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    
        if (!Schema::hasTable('modalidad_nivel')) {
            Schema::create('modalidad_nivel', function (Blueprint $table) {
                $table->smallIncrements('id')->unsigned();

                $table->tinyInteger('modalidad_id')->unsigned();
                $table->tinyInteger('nivel_id')->unsigned();
                $table->tinyInteger('escuela_tipo_id')->unsigned()->nullable();

                $table->foreign('modalidad_id')
                    ->references('id')
                    ->on('modalidads')
                    ->onDelete('restrict');

                $table->foreign('nivel_id')
                    ->references('id')
                    ->on('nivels')
                    ->onDelete('restrict');

                $table->foreign('escuela_tipo_id')
                    ->references('id')
                    ->on('escuela_tipos')
                    ->onDelete('restrict');

                // Esta clave única evita duplicados de la misma combinación
                $table->unique(['modalidad_id', 'nivel_id']);
                $table->timestamps();
                $table->softDeletes();
            });
        };
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        // NO CONVIENE ELIMINARLO, HACERLO DE FORMA MANUAL.
       // Schema::dropIfExists('modalidad_nivel');
    }
};
