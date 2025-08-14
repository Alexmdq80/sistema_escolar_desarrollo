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
        Schema::rename('categoria_georef', 'georef_categorias');
        Schema::rename('fuente_georef', 'georef_fuentes');
        Schema::rename('funcion_georef', 'georef_funcions');
        // estas las nombro como georef, porque no las uso para realizar consultas, 
        // quedaron al generar la BD, quizá pueda elimnarlas luego.
        Schema::rename('localidad', 'georef_localidads');
        Schema::rename('asentamiento', 'georef_asentamientos');
        // *********************************
        Schema::rename('continente', 'continentes');
        Schema::rename('pais', 'nacions');
        Schema::rename('provincia', 'provincias');
        Schema::rename('departamento', 'departamentos');
        Schema::rename('municipio', 'municipios');    
        Schema::rename('localidad_asentamiento', 'localidads'); 
        Schema::rename('localidad_censal', 'localidad_censals'); 
        //
        Schema::rename('region_educativa', 'regions'); 

        Schema::rename('calle', 'calles');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('georef_categorias', 'categoria_georef');
        Schema::rename('georef_fuentes','fuente_georef');
        Schema::rename('georef_funcions','funcion_georef');
        // estas las nombro como georef, porque no las uso para realizar consultas, 
        // quedaron al generar la BD, quizá pueda elimnarlas luego.
        Schema::rename('georef_localidads','localidad',);
        Schema::rename('georef_asentamientos','asentamiento');
        // *********************************
        Schema::rename('continentes','continente');
        Schema::rename('nacions','pais',);
        Schema::rename('provincias','provincia');
        Schema::rename('departamentos','departamento');
        Schema::rename('municipios','municipio');    
        Schema::rename('localidads','localidad_asentamiento'); 
        Schema::rename('localidad_censals','localidad_censal'); 
        //
        Schema::rename('regions','region_educativa'); 

        Schema::rename('calles','calle');
    }
};
