<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Http\Resources\PersonaResource;

class PersonaController extends Controller
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
        // $personas = Persona::all()->take(500)->paginate();
        $personas = Persona::paginate();
        
        return PersonaResource::collection($personas);
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
        //
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
