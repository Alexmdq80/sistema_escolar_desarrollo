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
        // renombrar tablas relacionadas a la escuelas
        Schema::rename('escuela', 'escuelas');
        Schema::rename('plan_estudio', 'plans');
        Schema::rename('ciclo_lectivo', 'lectivos');
        Schema::rename('ciclo_plan_estudio', 'plan_ciclos');
        Schema::rename('espacio_academico', 'espacios');
        Schema::rename('jornada', 'jornadas');
        Schema::rename('modalidad', 'modalidads');
        Schema::rename('nivel', 'nivels');
        Schema::rename('turno', 'turnos');
        Schema::rename('seccion_tipo', 'seccion_tipos');
        Schema::rename('propuesta_institucional', 'propuestas');
        Schema::rename('otras_ofertas', 'ofertas');

        Schema::rename('ambito', 'ambitos');
        Schema::rename('anio', 'anios');
        Schema::rename('anio_plan', 'plan_anios');
        Schema::rename('dependencia', 'dependencias');
        Schema::rename('sector', 'sectors');

        Schema::rename('escuela_nivel_modalidad', 'escuela_nivel');
        Schema::rename('escuela_PI', 'escuela_propuesta');
        Schema::rename('escuela_otras_ofertas', 'escuela_oferta');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('escuelas', 'escuela');
        Schema::rename('plans', 'plan_estudio');
        Schema::rename('lectivos', 'ciclo_lectivo');
        Schema::rename('plan_ciclos', 'ciclo_plan_estudio');
        Schema::rename('espacios', 'espacio_academico');
        Schema::rename('jornadas', 'jornada');
        Schema::rename('modalidads', 'modalidad');
        Schema::rename('nivels', 'nivel');
        Schema::rename('turnos', 'turno');
        Schema::rename('seccion_tipos', 'seccion_tipo');
        Schema::rename('propuestas', 'propuesta_institucional');

        Schema::rename('ofertas', 'otras_ofertas');
        Schema::rename('ambitos', 'ambito');
        Schema::rename('anios', 'anio');
        Schema::rename('plan_anios', 'anio_plan');
        Schema::rename('dependencias', 'dependencia');
        Schema::rename('sectors', 'sector');

        Schema::rename('escuela_nivel', 'escuela_nivel_modalidad');
        Schema::rename('escuela_propuesta', 'escuela_PI');
        Schema::rename('escuela_oferta', 'escuela_otras_ofertas');
    }
};
