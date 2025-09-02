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
        Schema::table('escuela_oferta', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();

            $table->renameColumn('id_escuela', 'escuela_id');
            $table->renameColumn('id_otras_ofertas', 'oferta_id');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('escuela_oferta', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();


            $table->renameColumn('escuela_id', 'id_escuela');
            $table->renameColumn('oferta_id', 'id_otras_ofertas');

        });
    }
};
