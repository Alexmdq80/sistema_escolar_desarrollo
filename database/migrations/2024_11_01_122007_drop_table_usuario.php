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
        Schema::table('usuario', function (Blueprint $table) {
            // SI EXISTE LA TABLA USUARIO, HAY QUE ELIMNARLA
            Schema::dropIfExists('usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
// SI NO EXISTE, HABRÍA QUE CREARLA OTRA VEZ, PARA REVERTIR LOS CAMBIOS.
        if (!Schema::hasTable('usuario')) {
            Schema::create('usuario', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nombre_usuario', 25)->unique();
                $table->string('nombre', 50);
                $table->string('apellido', 50);
                $table->string('clave', 255);
                $table->timestamps();
            });
        }

    }
};
