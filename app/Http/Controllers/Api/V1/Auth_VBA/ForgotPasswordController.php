<?php

namespace App\Http\Controllers\Api\V1\Auth_VBA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Http\Response;
use App\Events\PasswordResetRequested;

class ForgotPasswordController extends Controller
{
    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        // 1. Validar el email
        $request->validate(['email' => 'required|email']);

        // 2. Obtener el usuario
        $user = User::where('email', $request->email)->first();

        // 3. Si el usuario no existe, devuelve un mensaje genérico por seguridad
        if (!$user) {
            // No reveles si el email existe o no por seguridad.
            // Siempre responde con un mensaje de éxito aparente.
            return response()->json([
                'message' => 'Si tu dirección de correo electrónico existe en nuestros registros, recibirás un enlace de restablecimiento de contraseña.'
            ], Response::HTTP_OK);
        }

        // 4. Generar el token de restablecimiento de contraseña
        // Laravel se encarphp artisan make:controller Api/V1/Auth_VBA/ResetPasswordControllerga de almacenar este token en la tabla password_reset_tokens
        $token = Password::broker()->createToken($user);

        // 5. Enviar el correo electrónico con el enlace de restablecimiento
        try {
            Mail::to($user->email)->send(new PasswordResetMail($user, $token));

            // 6. Disparar evento de auditoría para la solicitud exitosa
            event(new PasswordResetRequested($user, $user->email));

        } catch (\Exception $e) {
            \Log::error('Error al enviar correo de restablecimiento de contraseña para ' . $user->email . ': ' . $e->getMessage());
            // Opcional: Auditar el fallo de envío si lo necesitas
            // AuthenticationAudit::create([... status: 'failed', reason: 'Mail sending failed' ...]);
            return response()->json([
                'message' => 'No se pudo enviar el correo de restablecimiento. Por favor, inténtalo de nuevo más tarde.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Si tu dirección de correo electrónico existe en nuestros registros, recibirás un enlace de restablecimiento de contraseña.'
        ], Response::HTTP_OK);
    }
}
