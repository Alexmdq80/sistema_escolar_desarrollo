<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Region_Educativa;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('region_educativa', function (Blueprint $table) {
            $table->tinyInteger('id')->unsigned()->primary();
            $table->boolean('vigente');
            $table->timestamps();

        });
        //CREAR TABLA DE PASE_MOTIVO
        for ($i=1; $i < 26; $i++){
            $re = new Region_Educativa();
            $re->id = $i;
            $re->vigente = true;
            $re->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('region_educativa', function (Blueprint $table) {
            Schema::dropIfExists('region_educativa');
        });
    }
};
