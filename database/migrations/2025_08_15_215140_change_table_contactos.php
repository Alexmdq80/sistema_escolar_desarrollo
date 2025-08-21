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
            $table->softDeletes();

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
            $table->dropSoftDeletes();

            $table->dropForeign(['persona_id']);

            $table->dropIndex('contactos_persona_id_foreign');

            $table->renameColumn('persona_id', 'id_persona');

        });
    }
};
