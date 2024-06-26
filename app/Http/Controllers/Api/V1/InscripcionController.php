<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Http\Resources\InscripcionResource;

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

    public function showByEspacio(Request $request)
    {
        // $inscripcion = Inscripcion::latest()->take(5)->get();
        $id = $request->input('id');
        $inscripcion = Inscripcion::where('id_espacio_academico', $id)->get();
        
        // return $inscripcion;
        return InscripcionResource::collection($inscripcion);
        // return $id;
        // return $request
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