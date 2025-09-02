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
        Schema::table('nacions', function (Blueprint $table) {
            DB::statement('ALTER TABLE nacions MODIFY id TINYINT UNSIGNED');
            $table->dropPrimary('id');
        });
        Schema::table('nacions', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();

            $table->tinyIncrements('id')->change(); // este no lo voy a revertir

            $table->renameColumn('id_continente', 'continente_id');

            $table->foreign('continente_id')
                  ->references('id')
                  ->on('continentes')
                  ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nacions', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();

            $table->dropForeign(['continente_id']);

            $table->dropIndex('nacions_continente_id_foreign');

            $table->renameColumn('continente_id', 'id_continente');

        });
    }
};
