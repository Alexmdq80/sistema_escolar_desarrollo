<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\UsuarioEscuela;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * @group Auth
 */
class AngularLoginController extends Controller
{
    public function __invoke(Request $request)
    {
        // HAY QUE REVISARLO, SEGURRAMENTE NO ESTÉ FUNCIONANDO

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'id_escuela' => ['required']
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            throw ValidationException::withMessages([
                'email' => ['El usuario y/o la contraseña no son válidas.'],
            ]);
        }

        $ue = UsuarioEscuela::where('usuario_id', $usuario->id)
                            ->where('escuela_id', $request->id_escuela)
                            ->with('UsuarioTipo')
                            ->first();

        if (!$ue) {
            throw ValidationException::withMessages([
                'usuario_escuela' => ['El usuario no tiene permisos para ese colegio.'],
            ]);
        }

        if (!$ue->verificado) {
            throw ValidationException::withMessages([
                'usuario_escuela' => ['El usuario no está verificado.'],
            ]);
        }


        $device    = substr($request->userAgent() ?? '', 0, 255);
        $expiresAt = $request->remember ? null : now()->addMinutes(60);

        return response()->json([
           'access_token' => $user->createToken($device, expiresAt: $expiresAt)->plainTextToken,
           'usuario' => $usuario,
           'usuario_escuela' => $ue
        ], Response::HTTP_CREATED);

     //   return response()->json($user);
    }

}
