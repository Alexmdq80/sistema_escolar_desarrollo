<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Inscripcion;
use App\Http\Resources\PersonaResource;
use App\Http\Resources\InscripcionResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ListadosInicialesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // COMUNIDAD EDUCATIVA'
        $request->validate([
            'escuela_id' => ['required', 'exists:escuelas,id'],
        ]);

        $escuelaId = $request->input('escuela_id');

        /*$personas = Persona::with(['documentoTipo', 'legajos'])
                    ->withExists(['inscripcion as tiene_inscripcion_activa'])
                    ->get();  */     
        $personas = Persona::with([
            'documentoTipo',
            'sexo', // Añadir si se necesita en el Resource
            'genero', // Añadir si se necesita en el Resource
            'nacionalidad',
            // Carga restringida de legajos:
            'legajos' => function ($query) use ($escuelaId) { 
                $query->where('escuela_id', $escuelaId);
            }
        ])
        //->withExists(['inscripcion as tiene_inscripcion_activa']) 
        ->withExists(['inscripcion as tiene_inscripcion_activa_en_escuela' => function ($query) use ($escuelaId) {
            
            // De Inscripcion a Espacio
            $query->whereHas('espacio', function ($q) use ($escuelaId) {                
                // De Espacio a Propuesta
                $q->whereHas('propuesta', function ($qq) use ($escuelaId) {
                    $qq->where('escuela_id', $escuelaId);
                    // De Propuesta a la tabla pivot de Escuelas
                    //$qq->whereHas('escuelas', function ($qqq) use ($escuelaId) {
                        
                        // Aplica el filtro final
                    //    $qqq->where('escuela_id', $escuelaId);
                    //});
                });
            });
        }])
        ->withExists(['historialInscripciones as tuvo_inscripcion_en_escuela' => function ($query) use ($escuelaId) {
            
            // 🛑 CLAVE: Ignorar SoftDeletes en la tabla 'inscripciones'
            //$query->onlyTrashed(); 
            
            // El resto de la cadena de filtros sigue siendo necesaria para asegurar que fue en la escuela correcta
            $query->whereHas('espacio', function ($q) use ($escuelaId) {
                $q->whereHas('propuesta', function ($qq) use ($escuelaId) {
                    $qq->where('escuela_id', $escuelaId); 
                    //$qq->whereHas('escuela', function ($qqq) use ($escuelaId) {
                        // Aquí, SoftDeletes de Propuesta/Pivot SÍ se mantienen, 
                        // asegurando que el vínculo Propuesta-Escuela sigue siendo válido.
                    //    $qqq->where('escuela_id', $escuelaId); 
                    //});
                });
            });
        }])
            
        // Ordenamiento (Demostrado que funciona):
        ->orderBy('personas.apellido', 'asc')
        ->orderBy('personas.nombre', 'asc')
            
        // Select (Buena práctica):
        //->select('personas.*') 
        ->get();

        $personasColeccion = PersonaResource::collection($personas);
        // FIN COMUNIDAD EDUCATIVA

        // INSCRIPCIONES
        $inscripciones = Inscripcion::with([
            'persona', // Relación directa con el estudiante
    //        'persona.sexo',
    //        'persona.genero',
    //        'persona.legajos' => function ($query) use ($escuelaId) { // Restringe la carga de legajos
    //            $query->where('escuela_id', $escuelaId);
    //        },
    //        'persona.documentoTipo', // A través de persona para el tipo de documento
            'espacio.propuesta.cicloLectivo', // A través de espacio y propuesta para el ciclo lectivo
            'espacio.propuesta.planAnio.anio', // A través de espacio, propuesta y planAnio para el año
            'espacio.propuesta.planAnio.plan', // A través de espacio, propuesta y planAnio para el plan de estudio
            'espacio.propuesta.turnoInicio' // A través de espacio y propuesta para el turno
        ])
    // Joins para acceder a las tablas necesarias para el filtro y ordenamiento
        ->join('espacios', 'inscripcions.espacio_id', '=', 'espacios.id')
        ->join('propuestas', 'espacios.propuesta_id', '=', 'propuestas.id')
        //->join('escuela_propuesta', 'propuestas.id', '=', 'escuela_propuesta.propuesta_id') 
        // 2. Aplicar el filtro Where sobre la clave de la tabla pivote
       // ->where('escuela_propuesta.escuela_id', $escuelaId)
        ->where('propuestas.escuela_id', $escuelaId)
        ->join('lectivos', 'propuestas.lectivo_id', '=', 'lectivos.id')
        ->join('turnos', 'propuestas.turno_inicio_id', '=', 'turnos.id')
        ->join('plan_anios', 'propuestas.plan_anio_id', '=', 'plan_anios.id')
        ->join('anios', 'plan_anios.anio_id', '=', 'anios.id')
        ->join('personas', 'inscripcions.persona_id', '=', 'personas.id')
        ->orderBy('lectivos.orden', 'asc')
        ->orderBy('turnos.orden', 'asc')
    //     ->orderBy(DB::raw('CAST(anios.nombre AS UNSIGNED)'), 'asc')
        ->orderBy('anios.orden', 'asc')
        ->orderBy('espacios.division', 'asc')
        ->orderBy('personas.apellido', 'asc')
        ->orderBy('personas.nombre', 'asc')
        ->select('inscripcions.*') // This is crucial to avoid column conflicts
        ->get();

        $inscripcionesColeccion = InscripcionResource::collection($inscripciones);    
        // FIN INSCRIPCIONES

        // ARMADO DEL ARRAY
    
        $listadosArray = [
            'comunidad_educativa' => $personasColeccion,
            'inscripciones' => $inscripcionesColeccion
        ];
        //******************** */

        $jsonResponse = json_encode([
            'data' => $listadosArray
        ], JSON_UNESCAPED_UNICODE);

        // Retorna la respuesta ya serializada con el encabezado correcto
        return response($jsonResponse, 200)
            ->header('Content-Type', 'application/json; charset=utf-8');

    }

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
    public function show(Persona $persona)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Persona $persona)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $persona)
    {
        //
    }
}
