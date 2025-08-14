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
        // renombrar tablas relacionadas a datos personales
        Schema::rename('persona', 'personas');
        Schema::rename('contacto', 'contactos');
        Schema::rename('domicilio', 'domicilios');
        Schema::rename('sexo', 'sexos');
        Schema::rename('genero', 'generos');
        Schema::rename('documento_tipo', 'documento_tipos');
        Schema::rename('documento_situacion', 'documento_situacions');
        Schema::rename('legajo', 'legajos');
        Schema::rename('adulto_vinculo', 'vinculos');
        Schema::rename('vinculo_tipo', 'vinculo_tipos');       

        Schema::rename('estudiante_adulto_vinculo', 'persona_vinculo_persona');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('personas', 'persona');
        Schema::rename('contactos', 'contacto');
        Schema::rename('domicilios', 'domicilio');
        Schema::rename('sexos', 'sexo');
        Schema::rename('generos', 'genero');
        Schema::rename('documento_tipos', 'documento_tipo');
        Schema::rename('documento_situacions', 'documento_situacion');
        Schema::rename('legajos', 'legajo');
        Schema::rename('vinculos', 'adulto_vinculo');
        Schema::rename('vinculo_tipos', 'vinculo_tipo');  

        Schema::rename('persona_vinculo_persona', 'estudiante_adulto_vinculo');

    }
};
