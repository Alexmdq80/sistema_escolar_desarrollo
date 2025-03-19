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
        Schema::table('inscripcion_historial', function (Blueprint $table) {
            $table->dropForeign('inscripcion_historial_id_condicion_finalizacion_foreign');
            $table->dropColumn('id_condicion_finalizacion');
            $table->dropForeign('inscripcion_historial_id_usuario_old_foreign');
            $table->dropColumn('id_usuario_old');
            $table->dropForeign('inscripcion_historial_id_inscripcion_cierre_foreign');
            $table->dropColumn('id_inscripcion_cierre');
            $table->dropColumn('fecha_old');
            $table->dropColumn('observaciones');
            $table->dropColumn('created_at_old');
            $table->dropColumn('updated_at_old');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_historial', function (Blueprint $table) {
            $table->unsignedTinyInteger('id_condicion_finalizacion')->nullable();
            $table->foreign('id_condicion_finalizacion')->references('id')->on('condicion');
            $table->unsignedBigInteger('id_usuario_old')->nullable()->comment('Usuario que generó la inscripción original.');
            $table->foreign('id_usuario_old')->references('id')->on('usuario');
            $table->unsignedTinyInteger('id_inscripcion_cierre')->nullable();
            $table->foreign('id_inscripcion_cierre')->references('id')->on('inscripcion_cierre');
            $table->date('fecha_old')->nullable();
            $table->string('observaciones', 255)->nullable();
            $table->timestamp('created_at_old')->nullable();
            $table->timestamp('updated_at_old')->nullable();
        });
    }
};
