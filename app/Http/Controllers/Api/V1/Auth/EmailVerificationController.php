<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\URL; // Si también mueves la lógica de 'verify' aquí
use App\Events\EmailVerificationLinkSent; // <-- ¡Importa tu evento!
use App\Events\EmailVerifiedAction;

class EmailVerificationController extends Controller
{
    // Método para manejar la verificación del correo
    public function verify(Request $request, $id, $token)
    {
        // --- AÑADE ESTA LÍNEA TEMPORALMENTE ---
        \Log::info('Intentando verificar email. Request URL: ' . $request->fullUrl());
        // --- FIN DE LA LÍNEA TEMPORAL ---
        // 1. Buscar al usuario por ID
        $user = User::find($id);

        // 2. Verificar si el usuario existe
        if (!$user) {
            return response()->json(['message' => 'Enlace de verificación inválido o usuario no encontrado.'], 404);
        }

        // 3. Verificar si el correo ya está verificado
        if ($user->email_verified_at !== null) {
            return response()->json(['message' => 'Tu correo electrónico ya ha sido verificado.'], 200);
        }

        // 4. Verificar el token.
        if ($user->verification_token !== $token) {
            return response()->json(['message' => 'Token de verificación inválido.'], 400);
        }

        // 5. Opcional: Verificar la expiración del enlace firmado por Laravel
        if (! URL::hasValidSignature($request)) {
            return response()->json(['message' => 'El enlace de verificación ha expirado o es inválido (firma no válida).'], 400);
        }

        // 6. Si todas las verificaciones pasan, marcar el correo como verificado
        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();

        event(new EmailVerifiedAction($user, 'verification_link_click'));

        // 7. Responder al usuario
        return response()->json(['message' => '¡Felicidades! Tu correo electrónico ha sido verificado con éxito.'], 200);
    }

    // Método para manejar el reenvío del correo de verificación
   /* public function resend(Request $request)
    {
        $request->validate(['email' => 'required|email|max:255']);

        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'Si el correo electrónico existe en nuestros registros, se ha enviado un nuevo enlace de verificación.'], 200);
        }

        if ($user->email_verified_at !== null) {
            return response()->json(['message' => 'Tu correo electrónico ya ha sido verificado.'], 200);
        }

        $user->verification_token = Str::random(60);
        $user->save();

        try {
            Mail::to($user->email)->send(new EmailVerificationMail($user));
            event(new EmailVerificationLinkSent($request->user(), $request->user()->email, 'resend'));

        } catch (\Exception $e) {
            \Log::error('Error al reenviar correo de verificación para ' . $user->email . ': ' . $e->getMessage());
            return response()->json(['message' => 'No se pudo reenviar el correo de verificación. Por favor, inténtalo de nuevo más tarde.'], 500);
        }

        return response()->json(['message' => 'Se ha enviado un nuevo enlace de verificación a tu correo electrónico.'], 200);
    }*/
    // En EmailVerificationController.php
    public function resendAuthenticated(Request $request)
    {
        $user = $request->user(); // El usuario ya está autenticado

        if ($user->email_verified_at !== null) {
            return response()->json(['message' => 'Tu correo electrónico ya ha sido verificado.'], 200);
        }

        $user->verification_token = Str::random(60);
        $user->save();

        try {
            Mail::to($user->email)->send(new EmailVerificationMail($user));
            event(new EmailVerificationLinkSent($request->user(), $request->user()->email, 'resend'));

        } catch (\Exception $e) {
            \Log::error('Error al reenviar correo de verificación autenticado para ' . $user->email . ': ' . $e->getMessage());
            return response()->json(['message' => 'No se pudo reenviar el correo de verificación. Por favor, inténtalo de nuevo más tarde.'], 500);
        }

        return response()->json(['message' => 'Se ha enviado un nuevo enlace de verificación a tu correo electrónico.'], 200);
    }


}
