<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usuario_Escuela;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * @group Auth
 */
class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'id_escuela' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['El usuario y/o la contraseña no son válidas.'],
            ]);
        }

        $ue = Usuario_Escuela::where('id_usuario', $user->id)
                            ->where('id_escuela', $request->id_escuela)->get();

        if ($ue->count() === 0) {
            throw ValidationException::withMessages([
                'usuario_escuela' => ['El usuario no tiene permisos para ese colegio.'],
            ]);
        }
        return response()->json($user->id);

        $device    = substr($request->userAgent() ?? '', 0, 255);
        $expiresAt = $request->remember ? null : now()->addMinutes(60);

        return response()->json([
           'access_token' => $user->createToken($device, expiresAt: $expiresAt)->plainTextToken,
        ], Response::HTTP_CREATED);

     //   return response()->json($user);
    }

}
