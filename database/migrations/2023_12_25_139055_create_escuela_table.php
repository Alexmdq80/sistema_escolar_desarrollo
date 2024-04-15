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
        if (!Schema::hasTable('escuela')) {
            Schema::create('escuela', function (Blueprint $table) {
                $table->mediumIncrements('id');
                $table->smallInteger('id_localidad_asentamiento')->unsigned()->nullable();          
                $table->foreign('id_localidad_asentamiento')->references('id')->on('localidad_asentamiento');
                $table->smallInteger('id_departamento')->unsigned()->nullable();          
                $table->foreign('id_departamento')->references('id')->on('departamento'); 
                $table->tinyInteger('id_provincia')->unsigned()->nullable();          
                $table->foreign('id_provincia')->references('id')->on('provincia');      
                $table->tinyInteger('id_pais')->unsigned();
                $table->foreign('id_pais')->references('id')->on('pais');      
                $table->tinyInteger('id_continente')->unsigned();
                $table->foreign('id_continente')->references('id')->on('continente');
                $table->tinyInteger('id_ambito')->unsigned();
                $table->foreign('id_ambito')->references('id')->on('ambito');
                $table->tinyInteger('id_dependencia')->unsigned();
                $table->foreign('id_dependencia')->references('id')->on('dependencia');
                $table->tinyInteger('id_sector')->unsigned();
                $table->foreign('id_sector')->references('id')->on('sector');
                $table->string('cue_anexo', 9)->unique()->nullable();
                $table->string('clave_provincial')->nullable();
                $table->string('nombre', 140);
                $table->string('numero', 6)->nullable();
                $table->string('codigo_localidad', 8)->nullable();
                $table->string('domicilio', 180)->nullable();
                $table->string('telefono', 50)->nullable();
                $table->string('email', 80)->nullable();
                $table->string('codigo_postal', 6)->nullable();
                $table->boolean('modalidad_comun');
                $table->boolean('modalidad_especial');
                $table->boolean('modalidad_adultos');
                $table->boolean('comun_inicial_maternal');
                $table->boolean('comun_inicial_infantes');
                $table->boolean('comun_primario');
                $table->boolean('comun_secundario');
                $table->boolean('comun_secundario_inet');
                $table->boolean('comun_snu');
                $table->boolean('comun_snu_inet');
                $table->boolean('comun_snu_cursos');
                $table->boolean('especial_temprana');
                $table->boolean('especial_inicial');
                $table->boolean('especial_primario');
                $table->boolean('especial_secundario');
                $table->boolean('especial_integracion');
                $table->boolean('adultos_primario');
                $table->boolean('adultos_secundario');
                $table->boolean('adultos_profesional');
                $table->boolean('adultos_profesional_inet');
                $table->boolean('adultos_alfabetizacion');
                $table->boolean('hospitalario_inicial');
                $table->boolean('hospitalario_primario');
                $table->boolean('hospitalario_secundario');
                $table->boolean('talleres_artistica');
                $table->boolean('servicios_complementarios');           
        
                //    $table->timestamps();
            });
        }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     //   Schema::dropIfExists('escuela');
    }
};
