<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

// Importá todos tus modelos de referencia
use App\Models\DocumentoSituacion;
use App\Models\Sexo;
// use App\Models\OtroModeloReferencia; 
// use App\Models\TercerModeloReferencia;

// Importá tus Resources si los usás (¡Recomendado!)
use App\Http\Resources\DocumentoSituacionResource;
use App\Http\Resources\SexoResource;
// use App\Http\Resources\OtroModeloResource; 

class ReferenceDataController extends Controller
{
    /**
     * Consolida todas las listas de referencia pequeñas en una sola respuesta.
     */
    public function index(Request $request)
    //: JsonResponse
    {
        $documentosSituacion = DocumentoSituacion::where('vigente', true)->get();
        $documentosSituacionColeccion = DocumentoSituacionResource::collection($documentosSituacion);
        
        $sexo = Sexo::where('vigente', true)->get();
        $sexoColeccion = SexoResource::collection($sexo);
       
        $referenciasArray = [
            'documentos_situacion' => DocumentoSituacionResource::collection($documentosSituacion)->toArray($request),
            'sexo' => SexoResource::collection($sexoColeccion)->toArray($request),
 
            // 'otra_lista' => OtroModeloResource::collection($otraLista)->toArray($request),
        ];

        
        $jsonResponse = json_encode([
            'data' => $referenciasArray->toArray($request)
        ], JSON_UNESCAPED_UNICODE);

        // Retorna la respuesta ya serializada con el encabezado correcto
        return response($jsonResponse, 200)
            ->header('Content-Type', 'application/json; charset=utf-8');
            
    }
}