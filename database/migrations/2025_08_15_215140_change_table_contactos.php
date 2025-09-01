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
        Schema::table('contactos', function (Blueprint $table) {
            // Eliminar la propiedad AUTO_INCREMENT de la columna 'id'
            // Esto se debe hacer con una sentencia SQL cruda en este caso
            DB::statement('ALTER TABLE contactos MODIFY id INT');
            $table->dropPrimary('id');
        });
        Schema::table('contactos', function (Blueprint $table) {
            $table->softDeletes();
            // REUBICAR COLUMNAS / MODIFICAR
            $table->bigIncrements('id')->change();
            
            //$table->unsignedBigInteger('id')->autoIncrement()->change();
            $table->unsignedBigInteger('id_persona')->change();

            $table->renameColumn('id_persona', 'persona_id');

            $table->foreign('persona_id')
                ->references('id')
                ->on('personas')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contactos', function (Blueprint $table) {
            // Eliminar la propiedad AUTO_INCREMENT de la columna 'id'
            // Esto se debe hacer con una sentencia SQL cruda en este caso
            DB::statement('ALTER TABLE contactos MODIFY id BIGINT');
            $table->dropPrimary('id');
        });
        Schema::table('contactos', function (Blueprint $table) {
            $table->dropSoftDeletes();

            $table->dropForeign(['persona_id']);

            $table->dropIndex('contactos_persona_id_foreign');
        });

        Schema::table('contactos', function (Blueprint $table) {
            // REUBICAR COLUMNAS / MODIFICAR
            $table->increments('id')->change();
            $table->integer('persona_id')->unsigned()->change();

            $table->renameColumn('persona_id', 'id_persona');
        });
    }
};
