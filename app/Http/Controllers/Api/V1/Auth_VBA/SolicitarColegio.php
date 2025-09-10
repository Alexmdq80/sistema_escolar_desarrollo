<?php

namespace App\Http\Controllers\Api\V1\Auth_VBA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\EscuelaUsuario;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class SolicitarColegio extends Controller
{
    public function solicitarColegio(Request $request): JsonResponse {

        $request->validate([
            'escuela_id' => ['required', 'exists:escuelas,id'] // Se agregó 'exists' para mayor seguridad
        ]);

        $usuario = $request->user();

        $ue = EscuelaUsuario::firstOrCreate(
            [
                'usuario_id' => $usuario->id,
                'escuela_id' => $request->escuela_id
            ],
            [
                'verified_at' => null,
                'usuario_tipo_id' => 5
            ]
        );

        if (! $ue->wasRecentlyCreated) {
            return response()->json([
                'message' => 'El usuario ya tiene solicitado ese colegio.'
            ], Response::HTTP_CONFLICT);
        }

        // Cargamos las relaciones en la instancia de usuario existente.
        $usuario->load([
            'escuelaUsuarios.escuela',
            'escuelaUsuarios.usuarioTipo'
        ]);

        return response()->json($usuario, Response::HTTP_CREATED);

    }

}
