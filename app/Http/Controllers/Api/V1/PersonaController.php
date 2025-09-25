<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Http\Resources\PersonaResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'escuela_id' => ['required', 'exists:escuelas,id'],
        ]);

        $escuelaId = $request->input('escuela_id');

     /*   $personas = Persona::with([
            'documentoTipo',
            'sexo',
            'genero',
            'inscripcion',
            'legajos' => function ($query) use ($escuelaId) { // Restringe la carga de legajos
                $query->where('escuela_id', $escuelaId);
            }
        ])
        ->withExists(['inscripcion as tiene_inscripcion_activa'])
        ->orderBy('personas.apellido', 'asc')
        ->orderBy('personas.nombre', 'asc')
        ->select('personas.*') // This is crucial to avoid column conflicts
        ->get();*/

        /*$personas = Persona::with(['documentoTipo', 'legajos'])
                    ->withExists(['inscripcion as tiene_inscripcion_activa'])
                    ->get();  */     
        $personas = Persona::with([
            'documentoTipo',
            'sexo', // Añadir si se necesita en el Resource
            'genero', // Añadir si se necesita en el Resource
            
            // Carga restringida de legajos:
            'legajos' => function ($query) use ($escuelaId) { 
                $query->where('escuela_id', $escuelaId);
            }
        ])
        // withExists (Demostrado que funciona en tu prueba):
        ->withExists(['inscripcion as tiene_inscripcion_activa']) 
            
        // Ordenamiento (Demostrado que funciona):
        ->orderBy('personas.apellido', 'asc')
        ->orderBy('personas.nombre', 'asc')
            
        // Select (Buena práctica):
        ->select('personas.*') 
        ->get();

        $personasColeccion = PersonaResource::collection($personas);

        // Serializa manualmente la colección de recursos con el flag JSON_UNESCAPED_UNICODE
        $jsonResponse = json_encode([
            'data' => $personasColeccion->toArray($request)
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
