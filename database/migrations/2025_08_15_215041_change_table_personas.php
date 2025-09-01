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
      Schema::table('personas', function (Blueprint $table) {
            // Eliminar la propiedad AUTO_INCREMENT de la columna 'id'
            // Esto se debe hacer con una sentencia SQL cruda en este caso
            DB::statement('ALTER TABLE personas MODIFY id INT');
            $table->dropPrimary('id');
      });
      Schema::table('personas', function (Blueprint $table) {
            $table->softDeletes();
// REUBICAR COLUMNAS / MODIFICAR
            $table->bigIncrements('id')->change();

            $table->renameColumn('id_documento_tipo', 'documento_tipo_id');
            $table->renameColumn('id_documento_situacion', 'documento_situacion_id');
            $table->renameColumn('id_sexo', 'sexo_id');
            $table->renameColumn('id_genero', 'genero_id');
            $table->renameColumn('nacionalidad_id_pais', 'nacionalidad_nacion_id');
            $table->renameColumn('nacimiento_lugar_id_pais', 'nacion_id');
            $table->renameColumn('nacimiento_lugar_id_provincia', 'provincia_id');
            $table->renameColumn('nacimiento_lugar_id_departamento', 'departamento_id');
            $table->renameColumn('nacimiento_lugar_id_localidad_asentamiento', 'localidad_id');

            $table->foreign('documento_tipo_id')
                  ->references('id')
                  ->on('documento_tipos')
                  ->onDelete('restrict');

            $table->foreign('documento_situacion_id')
                  ->references('id')
                  ->on('documento_situacions')
                  ->onDelete('restrict');

            $table->foreign('sexo_id')
                  ->references('id')
                  ->on('sexos')
                  ->onDelete('restrict');

            $table->foreign('genero_id')
                  ->references('id')
                  ->on('generos')
                  ->onDelete('restrict');

            $table->foreign('nacionalidad_nacion_id')
                  ->references('id')
                  ->on('nacions')
                  ->onDelete('restrict');

            $table->foreign('nacion_id')
                  ->references('id')
                  ->on('nacions')
                  ->onDelete('restrict');

            $table->foreign('provincia_id')
                  ->references('id')
                  ->on('provincias')
                  ->onDelete('restrict');

            $table->foreign('departamento_id')
                  ->references('id')
                  ->on('departamentos')
                  ->onDelete('restrict');

            $table->foreign('localidad_id')
                  ->references('id')
                  ->on('localidads')
                  ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('personas', function (Blueprint $table) {
            // Eliminar la propiedad AUTO_INCREMENT de la columna 'id'
            // Esto se debe hacer con una sentencia SQL cruda en este caso
            DB::statement('ALTER TABLE personas MODIFY id BIGINT');
            $table->dropPrimary('id');
      });
      Schema::table('personas', function (Blueprint $table) {
            $table->dropSoftDeletes();

            $table->dropForeign(['documento_tipo_id']);
            $table->dropForeign(['documento_situacion_id']);
            $table->dropForeign(['sexo_id']);
            $table->dropForeign(['genero_id']);
            $table->dropForeign(['nacionalidad_nacion_id']);
            $table->dropForeign(['nacion_id']);
            $table->dropForeign(['provincia_id']);
            $table->dropForeign(['departamento_id']);
            $table->dropForeign(['localidad_id']);

            $table->dropIndex('personas_documento_tipo_id_foreign');
            $table->dropIndex('personas_documento_situacion_id_foreign');
            $table->dropIndex('personas_sexo_id_foreign');
            $table->dropIndex('personas_genero_id_foreign');
            $table->dropIndex('personas_nacionalidad_nacion_id_foreign');
            $table->dropIndex('personas_nacion_id_foreign');
            $table->dropIndex('personas_provincia_id_foreign');
            $table->dropIndex('personas_departamento_id_foreign');
            $table->dropIndex('personas_localidad_id_foreign');
        });

        Schema::table('personas', function (Blueprint $table) {
            // REUBICAR COLUMNAS / MODIFICAR
            $table->increments('id')->change();

            $table->renameColumn('documento_tipo_id', 'id_documento_tipo');
            $table->renameColumn('documento_situacion_id', 'id_documento_situacion');
            $table->renameColumn('sexo_id', 'id_sexo');
            $table->renameColumn('genero_id', 'id_genero');
            $table->renameColumn('nacionalidad_nacion_id', 'nacionalidad_id_pais');
            $table->renameColumn('nacion_id', 'nacimiento_lugar_id_pais');
            $table->renameColumn('provincia_id', 'nacimiento_lugar_id_provincia');
            $table->renameColumn('departamento_id', 'nacimiento_lugar_id_departamento');
            $table->renameColumn('localidad_id', 'nacimiento_lugar_id_localidad_asentamiento');
        });
    }
};
