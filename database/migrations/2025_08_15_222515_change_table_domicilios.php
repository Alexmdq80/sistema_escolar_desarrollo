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
        Schema::table('domicilios', function (Blueprint $table) {
            $table->softDeletes();
            // sólo guardo la calle. Ahí ye quedaría la localidad.
            // si no se sabe la calle, o la localidad, se deberá poner en otros datos
            // la información que sea necesaria.

            //$table->uuid('uuid')->after('id')->nullable(); // Columna temporal
            $table->dropColumn('id_pais'); 
            $table->dropColumn('id_provincia'); 
            $table->dropColumn('id_departamento'); 
            $table->dropColumn('id_localidad_asentamiento'); 

            /*$table->renameColumn('id_pais', 'nacion_id');
            $table->renameColumn('id_provincia', 'provincia_id');
            $table->renameColumn('id_departamento', 'departamento_id');
            $table->renameColumn('id_localidad_asentamiento', 'localidad_id');*/

            $table->renameColumn('id_persona', 'persona_id');
            $table->renameColumn('id_calle', 'calle_id');
            $table->renameColumn('id_calle_entre1', 'calle_entre_1_id');
            $table->renameColumn('id_calle_entre2', 'calle_entre_2_id');

            /*$table->foreign('nacion_id')
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
                  ->onDelete('restrict');*/
            $table->foreign('persona_id')
                  ->references('id')
                  ->on('personas')
                  ->onDelete('restrict');

            $table->foreign('calle_id')
                  ->references('id')
                  ->on('calles')
                  ->onDelete('restrict');

            $table->foreign('calle_entre_1_id')
                  ->references('id')
                  ->on('calles')
                  ->onDelete('restrict');

            $table->foreign('calle_entre_2_id')
                  ->references('id')
                  ->on('calles')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('domicilios', function (Blueprint $table) {
            $table->dropSoftDeletes();
            //$table->dropColumn('uuid');

            /*$table->dropForeign(['nacion_id']);
            $table->dropForeign(['provincia_id']);
            $table->dropForeign(['departamento_id']);
            $table->dropForeign(['localidad_id']);*/

            $table->dropForeign(['persona_id']);
            $table->dropForeign(['calle_id']);
            $table->dropForeign(['calle_entre_1_id']);
            $table->dropForeign(['calle_entre_2_id']);

            /*$table->dropIndex('domicilios_nacion_id_foreign');
            $table->dropIndex('domicilios_provincia_id_foreign');
            $table->dropIndex('domicilios_departamento_id_foreign');
            $table->dropIndex('domicilios_localidad_id_foreign');*/
            $table->dropIndex('domicilios_persona_id_foreign');
            $table->dropIndex('domicilios_calle_id_foreign');
            $table->dropIndex('domicilios_calle_entre_1_id_foreign');
            $table->dropIndex('domicilios_calle_entre_2_id_foreign');

            /*$table->renameColumn('nacion_id', 'id_pais');
            $table->renameColumn('provincia_id', 'id_provincia');
            $table->renameColumn('departamento_id', 'id_departamento');
            $table->renameColumn('localidad_id', 'id_localidad_asentamiento');*/

            $table->renameColumn('persona_id', 'id_persona');
            $table->renameColumn('calle_id', 'id_calle');
            $table->renameColumn('calle_entre_1_id', 'id_calle_entre1');
            $table->renameColumn('calle_entre_2_id', 'id_calle_entre2');

            $table->tinyInteger('id_pais')->unsigned()->nullable();
            $table->tinyInteger('id_provincia')->unsigned()->nullable();
            $table->smallInteger('id_departamento')->unsigned()->nullable();
            $table->smallInteger('id_localidad_asentamiento')->unsigned()->nullable();

        });
    }
};
