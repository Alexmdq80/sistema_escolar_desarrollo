<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CacheControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cache_control')->insert([
        // Persona Reference Data
            [
            'key' => 'last_documento_situacions_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en la tabla de referencia documento_situacions',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_documento_tipos_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en la tabla de referencia documento_tipos',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_sexos_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en la tabla de referencia sexos',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_generos_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de generos',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        // *****************************************************************
        // Georef Reference Data
            [
            'key' => 'last_continentes_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de continentes',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_nacions_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de nacions',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_provincias_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de provincias',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_departamentos_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de departamentos',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_localidads_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de localidads',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_localidad_censals_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de localidad_censals',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_municipios_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de municipios',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_calles_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de calles',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_georef_asentamientos_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de georef_asentamientos',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_georef_categorias_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de categorías',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_georef_fuentes_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de fuentes',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_georef_funcions_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de funcions',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_georef_localidads_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de georef_localidads',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        //*************************************************************************** */
        //ESCUELAS
        [
            'key' => 'last_escuelas_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de escuelas',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_ambitos_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de ambitos',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_dependencias_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de dependencias',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_escuela_modalidad_nivel_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de modalidad y nivel de escuela',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_escuela_nivel_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de niveles de escuelas',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_escuela_oferta_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de ofertas de escuelas',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_escuela_tipos_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de tipos de escuela',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_escuela_ubicacions_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de ubicaciones de escuela',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_modalidads_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de modalidades',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_modalidad_nivel_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de modalidad y nivel',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_nivels_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de niveles',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_ofertas_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de ofertas',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_regions_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de regions',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_sectors_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de sectores',
            'created_at' => now(),
            'updated_at' => now(),
        ],

        //*************************************************************************** */
        //PROPUESTAS - ESPACIOS ACADÉMICOS - INSCRIPCIONES
        [
            'key' => 'last_escuela_propuesta_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de propuestas por escuelas',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_anios_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de años',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_cierre_causas_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de cierre de causas',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_condicions_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de condiciones',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_espacios_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de espacios académicos',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_jornadas_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de jornadas',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_lectivos_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de lectivos',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_plans_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de plans',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_plan_anios_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de años de plan',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_plan_ciclos_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de ciclos de plan',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_propuestas_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de propuestas de plan de estudio',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_salida_motivos_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de motivos de salida',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_seccion_tipos_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de tipos de sección',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'key' => 'last_turnos_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia de turnos de sección',
            'created_at' => now(),
            'updated_at' => now(),
        ]
        //*************************************************************************** */
        ]);
    }
}
