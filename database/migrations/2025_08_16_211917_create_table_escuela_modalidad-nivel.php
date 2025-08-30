<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // luego de correr esta migración, ejecutar el seeder
    // php artisan db:seed --class=ModalidadNivelSeeder
    // y luego correr la migración de la carpeta refactorizacion2
    // php artisan migrate --path=database/migrations/after_create_escuela_modalidad_nivel
    public function up(): void
    {

        if (!Schema::hasTable('escuela_modalidad_nivel')) {
            Schema::create('escuela_modalidad_nivel', function (Blueprint $table) {
                $table->increments('id');

                $table->mediumInteger('escuela_id')->unsigned();
                $table->smallInteger('modalidad_nivel_id')->unsigned();

                $table->foreign('escuela_id')
                    ->references('id')
                    ->on('escuelas')
                    ->onDelete('restrict');

                $table->foreign('modalidad_nivel_id')
                    ->references('id')
                    ->on('modalidad_nivel')
                    ->onDelete('restrict');

                $table->unique(['escuela_id', 'modalidad_nivel_id']);

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
       // ELIMINARLO MANUALMENTE
       //  Schema::dropIfExists('escuela_modalidad_nivel');
    }
};
