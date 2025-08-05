<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\Escuela;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class ObtenerEscuela extends Controller
{
    //escuelaPorCue
     public function escuelaPorCue(string $cueAnexo)
    {
        /*$request->validate([
            'cueAnexo' => ['required']
        ]);*/

        // Busca la escuela y, si no la encuentra, lanza un 404
        //$escuela = Escuela::where('cue_anexo', $cueAnexo)->firstOrFail();
        $escuela = Escuela::select([
                'id', // ID de la escuela
                'nombre', // Nombre de la escuela
                // Asegúrate de incluir también las claves foráneas necesarias para las relaciones
                'id_pais', // Si 'pais' se relaciona por 'pais_id'
                'id_provincia', // Si 'provincia' se relaciona por 'provincia_id'
                'id_departamento', // Si 'departamento' se relaciona por 'departamento_id'
                'id_localidad_asentamiento' // Si 'localidad_asentamiento' se relaciona por 'localidad_asentamiento_id'
            ])
            ->with([
            'pais' => function ($query) {
                $query->select(['id','nombre']);
            },
            'provincia' => function ($query) {
                $query->select(['id','iso_nombre']);
            },
            'departamento' => function ($query) {
                $query->select(['id','nombre']);
            },
            'localidad_asentamiento' => function ($query) {
                $query->select(['id','nombre']);
            }
        ])
        ->where('cue_anexo', $cueAnexo)
        ->firstOrFail();

        
        return response()->json($escuela, 200);
    }
}
