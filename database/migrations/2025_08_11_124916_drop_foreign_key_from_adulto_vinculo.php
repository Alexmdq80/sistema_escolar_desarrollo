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
        Schema::table('adulto_vinculo', function (Blueprint $table) {
            $table->dropForeign('adulto_vinculo_id_vinculo_tipo_foreign');
        });
        Schema::table('adulto_vinculo', function (Blueprint $table) {
            $table->dropIndex('adulto_vinculo_id_vinculo_tipo_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adulto_vinculo', function (Blueprint $table) {
            $table->foreign(['id_vinculo_tipo'])->references('id')->on('vinculo_tipo');
        });
    }
};
