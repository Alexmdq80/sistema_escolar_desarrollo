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
// REUBICAR COLUMNAS / MODIFICAR
            $table->unsignedBigInteger('id')->change();
            $table->unsignedBigInteger('id_persona')->change();

            $table->dropColumn('id_pais');
            $table->dropColumn('id_provincia');
            $table->dropColumn('id_departamento');
            $table->dropColumn('id_localidad_asentamiento');

            $table->renameColumn('id_persona', 'persona_id');
            $table->renameColumn('id_calle', 'calle_id');
            $table->renameColumn('id_calle_entre1', 'calle_entre_1_id');
            $table->renameColumn('id_calle_entre2', 'calle_entre_2_id');

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

            $table->dropForeign(['persona_id']);
            $table->dropForeign(['calle_id']);
            $table->dropForeign(['calle_entre_1_id']);
            $table->dropForeign(['calle_entre_2_id']);

            $table->dropIndex('domicilios_persona_id_foreign');
            $table->dropIndex('domicilios_calle_id_foreign');
            $table->dropIndex('domicilios_calle_entre_1_id_foreign');
            $table->dropIndex('domicilios_calle_entre_2_id_foreign');
        });

        Schema::table('domicilios', function (Blueprint $table) {
            // REUBICAR COLUMNAS / MODIFICAR
            $table->integer('id')->unsigned()->change();
            $table->integer('persona_id')->unsigned()->change();

            $table->renameColumn('persona_id', 'id_persona');
            $table->renameColumn('calle_id', 'id_calle');
            $table->renameColumn('calle_entre_1_id', 'id_calle_entre1');
            $table->renameColumn('calle_entre_2_id', 'id_calle_entre2');

            $table->tinyInteger('id_pais')->unsigned()->nullable()->after('id');
            $table->tinyInteger('id_provincia')->unsigned()->nullable()->after('id_pais');
            $table->smallInteger('id_departamento')->unsigned()->nullable()->after('id_provincia');
            $table->smallInteger('id_localidad_asentamiento')->unsigned()->nullable()->after('id_departamento');
        });
    }
};
