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
        Schema::table('vinculos', function (Blueprint $table) {
            DB::statement('ALTER TABLE vinculos MODIFY id TINYINT');
            $table->dropPrimary('id');
        });
        Schema::table('vinculos', function (Blueprint $table) {
            $table->softDeletes();
            
            $table->tinyIncrements('id')->change(); // este no lo voy a revertir
            
            $table->renameColumn('id_vinculo_tipo', 'vinculo_tipo_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vinculos', function (Blueprint $table) {
            $table->dropSoftDeletes();


            $table->renameColumn('vinculo_tipo_id', 'id_vinculo_tipo');


        });
    }
};
