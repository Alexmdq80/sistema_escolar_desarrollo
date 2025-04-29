<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Http\Resources\InscripcionResource;
use Illuminate\Http\JsonResponse;

class InscripcionController_VBA extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // '/////CORREGIR CUANDO SE TERMINE DE PROBAR////'
        // return Persona::latest()
        //             ->take(5)
        //             ->get();
        // return Persona::get()
        //                 ->paginate();

        // $valor = $request->input('id_espacio_academico');

        // $valor = $request->route('index');
        $inscripcion = Inscripcion::paginate();
        // $inscripcion = Inscripcion::where('id_espacio_academico', $valor)->get();

        return InscripcionResource::collection($inscripcion);
    }

    public function obtenerInscripcion(int $id): JsonResponse
    {
        $inscripcion = Inscripcion::with([
            /* PERSONA */
            'persona'
        /*  => function ($query) {
                $query->select(['id', 'nombre','apellido','documento_numero','posee_cpi_si',
                                'posee_docExt_si','CUIL_prefijo','CUIL_sufijo','nacimiento_fecha']);
            } NO SE PUEDE USAR UN SELECT, PORQUE SI NO CARGO LOS ID'S, ENTONCES NO ME CARGA LAS
            COLUMNAS RELACIONADAS CON LOS IDS  */ ,
            'persona.documento_tipo'=> function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona.documento_situacion'=> function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona.sexo'=> function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona.genero'=> function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona.nacionalidad'=> function ($query) {
                $query->select(['id', 'nombre','nacionalidad']);
            },
            'persona.nacimiento_pais'=> function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona.nacimiento_provincia' => function ($query) {
                $query->select(['id', 'iso_nombre']);
            },
            'persona.nacimiento_departamento' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona.nacimiento_localidad_asentamiento' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            /* DOMICILIO */
            'persona.domicilio' /* => function ($query) {
                $query->select(['id', 'numero','piso','torre','departamento','otros','codigo_postal']);
            } */ ,
            'persona.domicilio.calle' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona.domicilio.calle_entre1' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona.domicilio.calle_entre2' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona.domicilio.pais' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona.domicilio.provincia' => function ($query) {
                $query->select(['id', 'iso_nombre']);
            },
            'persona.domicilio.distrito' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona.domicilio.localidad_asentamiento' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            /* ******************* */
            /*  CONTACTO */
            'persona.contacto' => function ($query) {
                $query->select(['id', 'telefono_codigo_area','telefono',
                                'celular_codigo_area','celular','email']);
            },
            /* *************** */
            'persona_responsable_1',
            'persona_responsable_1.adulto'=> function ($query) {
                $query->select(['id', 'nombre','apellido','documento_numero','id_documento_tipo',
                                'posee_cpi_si','posee_docExt_si','nacionalidad_id_pais']);
            },
            'persona_responsable_1.adulto.documento_tipo'=> function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona_responsable_1.adulto.nacionalidad'=> function ($query) {
                $query->select(['id', 'nombre','nacionalidad']);
            },
            /* DOMICILIO */
            'persona_responsable_1.adulto.domicilio' /* => function ($query) {
                $query->select(['id', 'numero','piso','torre','departamento','otros','codigo_postal']);
            } */ ,
            'persona_responsable_1.adulto.domicilio.calle' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona_responsable_1.adulto.domicilio.calle_entre1' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona_responsable_1.adulto.domicilio.calle_entre2' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona_responsable_1.adulto.domicilio.pais' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona_responsable_1.adulto.domicilio.provincia' => function ($query) {
                $query->select(['id', 'iso_nombre']);
            },
            'persona_responsable_1.adulto.domicilio.distrito' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona_responsable_1.adulto.domicilio.localidad_asentamiento' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            /* ******************* */
            /*  CONTACTO */
            'persona_responsable_1.adulto.contacto' => function ($query) {
                $query->select(['id', 'telefono_codigo_area','telefono',
                                'celular_codigo_area','celular','email']);
            },
            /* *************** */
            'persona_responsable_2',
            'persona_responsable_2.adulto'=> function ($query) {
                $query->select(['id', 'nombre','apellido','documento_numero','id_documento_tipo',
                                'posee_cpi_si','posee_docExt_si','nacionalidad_id_pais']);
            },
            'persona_responsable_2.adulto.documento_tipo'=> function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona_responsable_2.adulto.nacionalidad'=> function ($query) {
                $query->select(['id', 'nombre','nacionalidad']);
            },
            /* DOMICILIO */
            'persona_responsable_2.adulto.domicilio' /* => function ($query) {
                $query->select(['id', 'numero','piso','torre','departamento','otros','codigo_postal']);
            } */ ,
            'persona_responsable_2.adulto.domicilio.calle' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona_responsable_2.adulto.domicilio.calle_entre1' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona_responsable_2.adulto.domicilio.calle_entre2' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona_responsable_2.adulto.domicilio.pais' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona_responsable_2.adulto.domicilio.provincia' => function ($query) {
                $query->select(['id', 'iso_nombre']);
            },
            'persona_responsable_2.adulto.domicilio.distrito' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona_responsable_2.adulto.domicilio.localidad_asentamiento' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            /* ******************* */
            /*  CONTACTO */
            'persona_responsable_2.adulto.contacto' => function ($query) {
                $query->select(['id', 'telefono_codigo_area','telefono',
                                'celular_codigo_area','celular','email']);
            },
            /* *************** */
            'persona_restringida',
            'persona_restringida.adulto'=> function ($query) {
                $query->select(['id', 'nombre','apellido','documento_numero','id_documento_tipo',
                                'posee_cpi_si','posee_docExt_si','nacionalidad_id_pais']);
            },
            'persona_restringida.adulto.documento_tipo'=> function ($query) {
                $query->select(['id', 'nombre']);
            },
            'persona_restringida.adulto.nacionalidad'=> function ($query) {
                $query->select(['id', 'nombre','nacionalidad']);
            },
            /* *************** */
            /*  ESCUELA DE PROCEDENCIA **/
            'escuela_procedencia' => function ($query) {
                $query->select(['id', 'id_localidad_asentamiento','id_departamento',
                                'id_provincia','id_pais','id_ambito','id_sector',
                                'id_dependencia','nombre','numero']);
            },
            'escuela_procedencia.pais' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'escuela_procedencia.provincia' => function ($query) {
                $query->select(['id', 'iso_nombre']);
            },
            'escuela_procedencia.departamento' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'escuela_procedencia.localidad_asentamiento' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'escuela_procedencia.ambito' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'escuela_procedencia.sector' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'escuela_procedencia.dependencia' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'nivel_procedencia' => function ($query) {
                $query->select(['id', 'nombre']);
            },
            'modalidad_procedencia'  => function ($query) {
                $query->select(['id', 'nombre']);
            },
            /*              ************* */
            /*  ESCUELA DESTINO */
            'condicion' => function ($query) {
                $query->select(['id', 'nombre']);
            }
            ])
        /* ->select(['id','id_persona','codigo_abc','proyecto_inclusion_si','concurre_especial_si',
                    'asistente_externo_si','fecha'])*/
        ->find($id);

        if ($inscripcion) {
            return response()->json($inscripcion);
        } else {
            return response()->json(['mensaje' => 'Inscripción no encontrada'], 404);
        }
    }
    // public function showByEspacio(Request $request)

    // public function showByEspacio(Request $request)
    // {
    //     // $id = $request->id;

    //     $id = 7;
    //     // $inscripcion = Inscripcion::latest()->take(1)->get();
    //     $inscripcion = Inscripcion::where('id_espacio_academico', $id)->get();

    //     return InscripcionResource::collection($inscripcion);
    // }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Inscripcion $inscripcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inscripcion $inscripcion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inscripcion $inscripcion)
    {
        //
    }
}
