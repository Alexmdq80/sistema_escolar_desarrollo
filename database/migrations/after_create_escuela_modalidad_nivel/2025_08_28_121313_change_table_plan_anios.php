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
        Schema::table('plan_anios', function (Blueprint $table) {
            $table->softDeletes();
    
            $table->dropColumn('id_ciclo_plan_estudio');

            $table->renameColumn('id_plan_estudio', 'plan_id');
            $table->renameColumn('id_anio', 'anio_id');

            $table->foreign('plan_id')
                  ->references('id')
                  ->on('plans')
                  ->onDelete('restrict');

            $table->foreign('anio_id')
                  ->references('id')
                  ->on('anios')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_anios', function (Blueprint $table) {
            $table->dropSoftDeletes();

            $table->dropForeign(['plan_id']);
            $table->dropForeign(['anio_id']);

            $table->dropIndex('plan_anios_plan_id_foreign');
            $table->dropIndex('plan_anios_anio_id_foreign');

            $table->renameColumn('plan_id', 'id_plan_estudio');
            $table->renameColumn('anio_id', 'id_anio');

            // luego habría que correr algún seeder en caso de querer restaurar por completo la BD
            $table->tinyInteger('id_ciclo_plan_estudio')->after('id')->unsigned();

        });
    }
};
