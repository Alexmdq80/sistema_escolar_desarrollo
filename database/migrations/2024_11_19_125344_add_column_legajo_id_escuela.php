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
        Schema::table('legajo', function (Blueprint $table) {
            //
            $table->mediumInteger('id_escuela')->unsigned()->after('id_persona');
            $table->foreign('id_escuela')->references('id')->on('escuela');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('legajo', function (Blueprint $table) {
            //
            $table->dropForeign('legajo_id_escuela_foreign');
            $table->dropColumn ('id_escuela');

        });
    }
};
