<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Http\Resources\InscripcionResource;
use Illuminate\Http\JsonResponse;

class InscripcionController extends Controller
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
        $inscripcion = Inscripcion::with(['persona','persona_firma','persona_responsable_1',
        'persona_responsable_2','persona_restringida','usuario','ciclo_lectivo','espacio_academico',
        'espacio_academico.plan_estudio','espacio_academico.anio',
        'escuela_procedencia','escuela_destino','nivel_procedencia','modalidad_procedencia',
        'condicion'])->find($id);

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
