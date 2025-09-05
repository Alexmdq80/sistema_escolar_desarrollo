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
        /*Schema::table('refresh_tokens', function (Blueprint $table) {
            $table->dropForeign('refresh_tokens_id_usuario_foreign');

        });*/
        Schema::table('refresh_tokens', function (Blueprint $table) {
            $table->dropIndex('refresh_tokens_id_usuario_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('refresh_tokens', function (Blueprint $table) {
            $table->foreign('refresh_tokens_id_usuario_foreign')->references('id')->on('usuario');

        });
    }
};
