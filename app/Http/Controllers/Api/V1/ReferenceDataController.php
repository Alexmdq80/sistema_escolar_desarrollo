<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

// Importá todos tus modelos de referencia
use App\Models\DocumentoSituacion;
use App\Models\DocumentoTipo;
use App\Models\Sexo;
use App\Models\Calle;
// use App\Models\OtroModeloReferencia;
// use App\Models\TercerModeloReferencia;

// Importá tus Resources si los usás (¡Recomendado!)
use App\Http\Resources\DocumentoSituacionResource;
use App\Http\Resources\DocumentoTipoResource;
use App\Http\Resources\SexoResource;
//use App\Http\Resources\CalleResource;
// use App\Http\Resources\OtroModeloResource;

class ReferenceDataController extends Controller
{
    /**
     * Consolida todas las listas de referencia pequeñas en una sola respuesta.
     */
    public function index(Request $request)
    //: JsonResponse
    {
        // 1. Obtener la bandera de la BD
        // Asumiendo que obtienes el valor 'last_ref_update' de tu tabla de configuración
        $serverPersonaLastUpdate = \DB::table('cache_control')->where('key', 'last_persona_ref_update')->value('value');

        $documentosSituacion = DocumentoSituacion::where('vigente', true)->get();
        $documentosSituacionColeccion = DocumentoSituacionResource::collection($documentosSituacion);

        $documentosTipo = DocumentoTipo::where('vigente', true)->get();
        $documentosTipoColeccion = DocumentoTipoResource::collection($documentosTipo);

        $sexo = Sexo::where('vigente', true)->get();
        $sexoColeccion = SexoResource::collection($sexo);

        //$calle = Calle::all();
        //$calleColeccion = CalleResource::collection($calle);

        $referenciasArray = [
            'documento_situacion' => DocumentoSituacionResource::collection($documentosSituacion)->toArray($request),
            'sexo' => SexoResource::collection($sexoColeccion)->toArray($request),
            'documento_tipo' => DocumentoTipoResource::collection($documentosTipoColeccion)->toArray($request),
            //'calle' => CalleResource::collection($calleColeccion)->toArray($request),
            // 'otra_lista' => OtroModeloResource::collection($otraLista)->toArray($request),
        ];


        $jsonResponse = json_encode([
            'metadata' => [
                'server_persona_last_update' => $serverPersonaLastUpdate
            ],
            'data' => $referenciasArray
        ], JSON_UNESCAPED_UNICODE);

        // Retorna la respuesta ya serializada con el encabezado correcto
        return response($jsonResponse, 200)
            ->header('Content-Type', 'application/json; charset=utf-8');

    }
}
