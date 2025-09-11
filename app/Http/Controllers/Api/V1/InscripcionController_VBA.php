<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InscripcionFinalizado;
use App\Models\HistorialInfoInscripcions;
use App\Models\Condicion;
use App\Models\Anio;
use App\Models\Legajo;
use App\Models\Espacio;
use App\Models\Inscripcion;
use App\Models\Persona;
use App\Models\Propuesta;
use App\Models\PlanAnio;
use App\Models\Plan;
use App\Models\Turno;
use App\Models\Lectivo;
use App\Models\DocumentoTipo;
use App\Http\Resources\InscripcionResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InscripcionController_VBA extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /*public function index()
    {
        $inscripciones = Inscripcion::with([
            // Otras relaciones...
            'espacio.propuesta.turnoInicio' // ¡Revisa que esté aquí y sin errores!
        ])->paginate(5);

        // DUMP THE RAW DATA
        dd($inscripciones->toArray());
    }*/
    public function index()
    {

        $inscripciones = Inscripcion::with([
            'persona', // Relación directa con el estudiante
            'persona.documentoTipo', // A través de persona para el tipo de documento
            'espacio.propuesta.cicloLectivo', // A través de espacio y propuesta para el ciclo lectivo
            'espacio.propuesta.planAnio.anio', // A través de espacio, propuesta y planAnio para el año
            'espacio.propuesta.planAnio.plan', // A través de espacio, propuesta y planAnio para el plan de estudio
            'espacio.propuesta.turnoInicio' // A través de espacio y propuesta para el turno
        ])->paginate(5);

        //->get();

        //return response()->json($inscripciones);
        // $inscripcion = Inscripcion::paginate();
        return InscripcionResource::collection($inscripciones);

    }
    /*public function index()
    {
        $inscripciones = Inscripcion::with([
            'persona.documentoTipo',
            'espacio.propuesta.cicloLectivo',
            'espacio.propuesta.planAnio.anio',
            'espacio.propuesta.planAnio.plan',
            'espacio.propuesta.turnoInicio'
        ])->paginate(5);
        //->get();

        // Devuelve los datos crudos para inspeccionarlos
        return response()->json($inscripciones);
    }*/

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
            return response()->json(['message' => 'Inscripción no encontrada'], 404);
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
    public function obtenerLegajo(Request $request): JsonResponse {
     //   \Log::info('request->method: ' . $request->method());
        if ($request->isMethod('put')) {
             return response()->json(['error' => 'Método no soportado'], 405);
        }

        $validator = Validator::make($request->all(), [
            'id_estudiante' => 'required|integer|exists:persona,id', // Asumiendo que tienes una tabla 'personas'
            'id_escuela' => 'required|integer|exists:escuela,id',   // Asumiendo que tienes una tabla 'escuelas'
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        $id_estudiante = $request->id_estudiante;
        $id_escuela = $request->id_escuela;

        $legajo = Legajo::where('id_persona', $id_estudiante)
                        ->where('id_escuela', $id_escuela)
                        ->first();

        if ($legajo) {
            return response()->json($legajo);
        } else {
            return response()->json(['message' => 'Legajo no encontrado'], 404);
        }

    }


    public function obtenerCondiciones(Request $request) {
        $anio = $request->anio;

        if ($anio === 6) {
            $condiciones = Condicion::where(function ($query) {
                $query->where('nombre', 'EGRESADO/A')
                    ->orWhere('nombre', 'FINALIZADO/A CON ÁREAS PENDIENTES');
                    })
                ->where('vigente', TRUE)
                ->select('nombre', 'id')
                ->get();
        } else {
            $condiciones = Condicion::where('nombre', '<>', 'EGRESADO/A')
                                    ->where('nombre', '<>', 'FINALIZADO/A CON ÁREAS PENDIENTES')
                                    ->where('vigente', TRUE)
                                    ->select('nombre','id')
                                    ->get();
        }

        if ($condiciones) {
            return response()->json($condiciones);
        } else {
            return response()->json(['message' => 'Año no encontrado'], 404);
        }

    }

    public function obtenerEspaciosAcademicos(Request $request) {
        $ciclo_lectivo = $request->ciclo_lectivo;
        $id_condicion = $request->id_condicion;
        $anio = $request->anio;

       /* $condicion = Condicion::find($id_condicion); */

        $condicion =Condicion::where('id', $id_condicion)->value('nombre');

        $query = Espacio_Academico::with('ciclo_lectivo', 'anio', 'ciclo_plan_estudio','plan_estudio','turno_inicio');

        if (str_contains(strtoupper($condicion), 'SIGUIENTE')) {
           // \Log::info('anio: ' . $anio);
            if (is_numeric($anio)) {
                $anio++;
            } else {
                $anio = 4;
            }
        }

        if ($ciclo_lectivo) {
            $query->whereHas('ciclo_lectivo', function ($q) use ($ciclo_lectivo) {
                $q->where('nombre', $ciclo_lectivo);
            });
        }

        if ($anio) {
            if (is_numeric($anio)) {
                if ($anio < 4) {
                    $query->whereHas('anio', function ($q) use ($anio) {
                        $q->where('nombre', $anio)
                          ->orWhere('nombre', 'A.F.');
                    });
                } else {
                    $query->whereHas('anio', function ($q) use ($anio) {
                        $q->where('nombre', $anio);
                    });
                }
            } else {
                $query->whereHas('ciclo_plan_estudio', function ($q) {
                    $q->where('nombre', 'CICLO BÁSICO');
                });
             }
        }

        //$ea = $query->get();

        $ea = $query->get()->map(function ($espacioAcademico) {
            return [
                'CICLO' => $espacioAcademico->ciclo_lectivo ? $espacioAcademico->ciclo_lectivo->nombre : null,
                'AÑO' => $espacioAcademico->anio ? $espacioAcademico->anio->nombre : null,
                'DIVISIÓN' => $espacioAcademico->division,
                'PLAN DE ESTUDIO' => $espacioAcademico->plan_estudio ? $espacioAcademico->plan_estudio->nombre : null,
                'TURNO' => $espacioAcademico->turno_inicio ? $espacioAcademico->turno_inicio->nombre : null,
                'ID' => $espacioAcademico->id,
                'ID_CICLO_LECTIVO' => $espacioAcademico->ciclo_lectivo->id
            ];
        });

        if ($ea->isEmpty()) {
            return response()->json(['message' => 'No se encontraron resultados con los parámetros proporcionados'], 404);
        } else {
            return response()->json($ea);
        }
    }


    public function corregirHistorialCondicion(Request $request) {
        $id_inscripcion_historial = $request->id_inscripcion_historial;
        $id_persona = $request->id_persona;
        $id_espacio_academico = $request->id_espacio_academico;
        $id_condicion = $request->id_condicion;

    /*    \Log::info('id_inscripcion_historial: ' . $id_inscripcion_historial);
        \Log::info('id_persona: ' . $id_persona);
        \Log::info('id_espacio_academico: ' . $id_espacio_academico);
        \Log::info('id_condicion: ' . $id_condicion); */

        /* CHEQUEAR QUE EL MOVIMIENTO A CORREGIR SEA DEL TIPO "FINALIZADO" EN HISTORIAL_INFO*/

        $ih_info = Inscripcion_Historial_Info::where('id_inscripcion_historial', $id_inscripcion_historial)
                                             ->first();

        if ($ih_info->id_inscripcion_cierre <> 1) { /* INSCRIPCIÓN POR FINALIZACIÓN */
            throw ValidationException::withMessages([
                'cierre' => ['Ese movimiento aplica sólo para inscripciones finalizadas.'],
            ]);
        }

        /* TRAER EL REGISTRO INSCRIPCION_FINALIZADO, TIENE QUE EXISTIR SÍ O SÍ */
        $i_finalizado = Inscripcion_Finalizado::with('condicion')
                                              ->where('id_inscripcion_historial', $id_inscripcion_historial)
                                              ->first();

        if (!$i_finalizado) {
            throw ValidationException::withMessages([
                'inscripcion_finalizado' => ['Error inesperado, no se encontró la finalización de la inscripción.'],
            ]);
        }

        $inscripcion = null;

        if ($i_finalizado->condicion->nombre != 'EGRESADO/A' &&
            $i_finalizado->condicion->nombre != 'FINALIZADO/A CON ÁREAS PENDIENTES') {
        /* TRAER EL REGISTRO INSCRIPCION, SÓLO SI AÚN ESTÁ EN COLEGIO,
        TENER EN CUENTA QUE SI LA CONDICIÓN ES CON PASE, PERO AÚN NO REALIZÓ EL PASE,
        IGUALMENTE VA A PODER CORREGIR DICHA SITUACIÓN. */
            $inscripcion = Inscripcion::where('id_persona', $id_persona)
                                      ->first();

            if (!$inscripcion) {
                throw ValidationException::withMessages([
                    'inscripcion' => ['Error inesperado, no se encontró la inscripción.'],
                ]);
            }
            $inscripcion->id_espacio_academico = $id_espacio_academico;
            $inscripcion->id_condicion = $id_condicion;
                    // Obtener el ID del usuario desde el token de Sanctum
            //$inscripcion->id_usuario = $request->user()->id;
            $inscripcion->save();
            /* CORREGIR LA CONDICIÓN Y EL ESPACIO ACADÉMICO EN LA INSCRIPCIÓN ÚLTIMA, SI LA HUBIERA,
               SI NO LA HAY ES PORQUE EGRESÓ O CAMBIÓ DE ESTABLECIMIENTO*/
        }
        /* CORREGIR LA CONDICIÓN EN EL INSCRIPCION_FINALIZADO  */
        $i_finalizado->id_condicion = $id_condicion;
        $i_finalizado->save();

        return response()->json([
            'message' => 'La información se ha actualizado correctamente.',
            'inscripcion' => $inscripcion, // Recargar para obtener la última versión de la relación
            'inscripcion_finalizado' => $i_finalizado, // Recargar para obtener la última versión de la relación
        ], 200);
///    'inscripcion_finalizado' => $i_finalizado->load('condicion'), // Recargar para obtener la última versión de la relación

    }

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
