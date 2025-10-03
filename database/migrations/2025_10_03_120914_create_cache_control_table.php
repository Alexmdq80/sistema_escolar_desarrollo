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
        // Creamos la tabla 'cache_control' para almacenar banderas o timestamps.
        Schema::create('cache_control', function (Blueprint $table) {
            
            // La columna clave ('key') será el identificador de la bandera (ej: 'last_ref_update').
            $table->string('key')->primary(); 
            
            // La columna valor ('value') almacenará el timestamp de la última actualización.
            $table->dateTime('value');
            
            // Opcional: descripción para saber qué bandera es.
            $table->string('descripcion')->nullable(); 
            
            // Timestamps opcionales para la tabla de control.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache_control');
    }
};
