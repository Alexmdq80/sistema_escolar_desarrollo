<?php

namespace App\Http\Controllers\Api\V1\Auth_VBA;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usuario_Escuela;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str; // Para generar el token
use Illuminate\Support\Facades\Mail; // Para enviar el mail
use App\Mail\EmailVerificationMail; // Tu nueva Mailable
use Illuminate\Support\Carbon; 

/**
 * @group Auth_VBA
 */
class VbaRegistroController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function __invoke(Request $request)
    {
        // Lógica
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuario'],
            'email_confirmation' => ['required', 'string', 'email', 'same:email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'id_escuela' => ['integer']
        ]);

        if (User::where('email', $request->email)->exists()) {
            return response()->json(['message' => 'El correo electrónico ya está registrado.'], Response::HTTP_CONFLICT);
        }

        $user = User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_token' => Str::random(60), // Genera un token aleatorio
            'email_verified_at' => null, // Asegurarse de que esté nulo al registrar
            'email_set_at' => \Carbon\Carbon::now(), // Para la lógica de 24h que discutimos
            'email_correction_attempts' => 0, // Para la lógica de intentos
        ]);

     /*   if ($request->id_escuela) {
            $ue = Usuario_Escuela::create([
                'id_escuela' => $request->id_escuela,
                'id_usuario' => $user->id,
                'verificado' => false,
                'id_usuario_tipo' => 5
            ]);
        } */

      //  dd($user->verification_token);

        Mail::to($user->email)->send(new EmailVerificationMail($user));

        return response()->json([
            'resultado' => 'usuario creado exitosamente, verfica tu correo electrónico.',
        ], Response::HTTP_CREATED);

        /*    $device = substr($request->userAgent() ?? '', 0, 255);

        return response()->json([
            'access_token' => $user->createToken($device)->plainTextToken,
        ], Response::HTTP_CREATED);
    */
    }
}
