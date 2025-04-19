<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

/**
 * @group Auth
 */
class RegistroController extends Controller
{
    public function __invoke(Request $request)
    {
        // Lógica

        if (User::where('email', $request->email)->exists()) {
            return response()->json(['message' => 'El correo electrónico ya está registrado.'], Response::HTTP_CONFLICT);
        }


        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuario'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'clave' => '123456',
        ]);

        return response()->json([
            'resultado' => 'usuario creado exitosamente',
        ], Response::HTTP_CREATED);

        /*    $device = substr($request->userAgent() ?? '', 0, 255);

        return response()->json([
            'access_token' => $user->createToken($device)->plainTextToken,
        ], Response::HTTP_CREATED);
    */
    }
}
