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
        Schema::table('estudiante_adulto_vinculo', function (Blueprint $table) {
            $table->dropForeign('estudiante_adulto_vinculo_id_adulto_vinculo_foreign');
            $table->dropForeign('estudiante_adulto_vinculo_id_persona_adulto_foreign');
            $table->dropForeign('estudiante_adulto_vinculo_id_persona_estudiante_foreign');
        });
        Schema::table('estudiante_adulto_vinculo', function (Blueprint $table) {
            $table->dropIndex('estudiante_adulto_vinculo_id_adulto_vinculo_foreign');
            $table->dropIndex('estudiante_adulto_vinculo_id_persona_adulto_foreign');
            $table->dropIndex('estudiante_adulto_vinculo_id_persona_estudiante_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estudiante_adulto_vinculo', function (Blueprint $table) {
            $table->foreign('id_adulto_vinculo')->references('id')->on('adulto_vinculo');
            $table->foreign('id_persona_adulto')->references('id')->on('persona');
            $table->foreign('id_persona_estudiante')->references('id')->on('persona');
        });
    }
};
