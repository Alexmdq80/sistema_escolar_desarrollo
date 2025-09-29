<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\DocumentoSituacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\DocumentoSituacionResource;

class DocumentoSituacionController extends Controller
{
    /**
     * Muestra una lista del recurso.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    //: \Illuminate\Http\JsonResponse
    {
        // Recupera todos los registros de DocumentoSituacion
        //$documentosSituacion = DocumentoSituacion::all();
        $documentosSituacion = DocumentoSituacion::where('vigente', true)->get();
        // Devuelve la colección en formato JSON
        //return response()->json([
        //    'data' => $documentosSituacion
        //], Response::HTTP_OK); // Código HTTP 200 (OK)

        //return DocumentoSituacionResource::collection($documentosSituacion)
        //    ->response()
        //    ->setStatusCode(Response::HTTP_OK);

        $documentosSituacionColeccion = DocumentoSituacionResource::collection($documentosSituacion);

        // Serializa manualmente la colección de recursos con el flag JSON_UNESCAPED_UNICODE
        $jsonResponse = json_encode([
            'data' => $documentosSituacionColeccion->toArray($request)
        ], JSON_UNESCAPED_UNICODE);

        // Retorna la respuesta ya serializada con el encabezado correcto
        return response($jsonResponse, 200)
            ->header('Content-Type', 'application/json; charset=utf-8');
       //******************************* */
       // $documentosSituacion = DocumentoSituacion::where('vigente', true)->get();
        
        // Genera el array de datos
       // $dataArray = DocumentoSituacionResource::collection($documentosSituacion)->toArray($request);

        // 🎯 Crea el JsonResponse manualmente con el helper
       // return response()->json(
       //     ['data' => $dataArray], 
       //     Response::HTTP_OK, 
       //     [], // No necesitas headers personalizados si solo es para JSON
       //     JSON_UNESCAPED_UNICODE // Laravel acepta el flag de json_encode como cuarto parámetro
       // );
    }

    /**
     * Almacena un recurso recién creado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        // TODO: Deberías añadir validación aquí, por ejemplo:
        /*
        $request->validate([
            'nombre' => 'required|string|max:255|unique:documento_situacions,nombre',
            'orden' => 'nullable|integer',
            'vigente' => 'boolean',
        ]);
        */

        $documentoSituacion = DocumentoSituacion::create($request->all());

        return response()->json([
            'message' => 'Documento de Situación creado exitosamente.',
            'data' => $documentoSituacion
        ], Response::HTTP_CREATED); // Código HTTP 201 (Created)
    }

    /**
     * Muestra el recurso especificado.
     *
     * @param  \App\Models\DocumentoSituacion  $documentoSituacion
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(DocumentoSituacion $documentoSituacion): \Illuminate\Http\JsonResponse
    {
        // El modelo ya viene inyectado por Route Model Binding
        return response()->json([
            'data' => $documentoSituacion->load('personas') // Opcional: Cargar la relación 'personas'
        ], Response::HTTP_OK);
    }

    /**
     * Actualiza el recurso especificado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocumentoSituacion  $documentoSituacion
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, DocumentoSituacion $documentoSituacion): \Illuminate\Http\JsonResponse
    {
        // TODO: Deberías añadir validación aquí

        $documentoSituacion->update($request->all());

        return response()->json([
            'message' => 'Documento de Situación actualizado exitosamente.',
            'data' => $documentoSituacion
        ], Response::HTTP_OK);
    }

    /**
     * Elimina el recurso especificado.
     *
     * @param  \App\Models\DocumentoSituacion  $documentoSituacion
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DocumentoSituacion $documentoSituacion): \Illuminate\Http\JsonResponse
    {
        // Gracias al SoftDeletes en el modelo, esto lo marcará como borrado.
        $documentoSituacion->delete();

        return response()->json([
            'message' => 'Documento de Situación eliminado exitosamente.'
        ], Response::HTTP_NO_CONTENT); // Código HTTP 204 (No Content)
    }
}