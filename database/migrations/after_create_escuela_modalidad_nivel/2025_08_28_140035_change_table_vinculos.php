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
            $table->softDeletes();
            
            $table->renameColumn('id_vinculo_tipo', 'vinculo_tipo_id');

            $table->foreign('vinculo_tipo_id')
                  ->references('id')
                  ->on('vinculo_tipos')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vinculos', function (Blueprint $table) {
            $table->dropSoftDeletes();

            $table->dropForeign(['vinculo_tipo_id']);

            $table->dropIndex('vinculos_vinculo_tipo_id_foreign');

            $table->renameColumn('vinculo_tipo_id', 'id_vinculo_tipo');


        });
    }
};
