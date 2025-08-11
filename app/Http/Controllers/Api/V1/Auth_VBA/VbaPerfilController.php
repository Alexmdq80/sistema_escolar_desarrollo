<?php

namespace App\Http\Controllers\Api\V1\Auth_VBA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use App\Mail\EmailVerificationMail;
use App\Mail\EmailChangedNotificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Events\EmailVerificationLinkSent;
use App\Events\OldEmailNotificationSent;
use App\Models\RefreshToken;
use App\Mail\ProfileUpdatedNotificationMail;
use App\Mail\ProfileUpdatedPasswordNotificationMail;
use App\Events\ProfileUpdatedNotificationSent;
use App\Events\ProfileUpdatedPasswordNotificationSent;
/**
 * @group Auth_VBA
 */
class VbaPerfilController extends Controller
{
    public function show(Request $request)
    {
        return response()->json($request->user()->only('nombre', 'email'));
    }

    public function update(Request $request)
    {
        // modifica el perfil del usuario autenticado
        // se requiere la contraseña actual para confirmar la identidad del usuario
        // sólo modifica el nombre y el apellido
        $validatedData = $request->validate([
            'nombre' => ['required', 'string'],
            'apellido' => ['required', 'string'],
            'current_password' => ['required', 'current_password'],
           // 'password'         => ['required', 'confirmed', Password::defaults()],
        ]);

        $usuario = $request->user(); // El usuario autenticado a través del token

        // 1. Verificar la contraseña actual
        if (!Hash::check($validatedData['current_password'], $usuario->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['La contraseña actual es incorrecta.'],
            ]);
        }

        $oldData = [
            'nombre' => $usuario->nombre,
            'apellido' => $usuario->apellido,
        ];

        $usuario->nombre = $validatedData['nombre'];
        $usuario->apellido = $validatedData['apellido'];

        $message = 'No se detectaron cambios en tu nombre o apellido.'; // Mensaje por defecto

        if ($usuario->isDirty('nombre') || $usuario->isDirty('apellido')) {
            $usuario->save();

            $newData = [
                'nombre' => $usuario->nombre,
                'apellido' => $usuario->apellido,
            ];

            // 2. Enviar email de notificación al usuario
            try {
                Mail::to($usuario->email)->send(new ProfileUpdatedNotificationMail($usuario, $oldData['nombre'], $newData['nombre'], $oldData['apellido'], $newData['apellido']));
                // 3. Auditar el envío de la notificación
                event(new ProfileUpdatedNotificationSent($usuario, $usuario->email, $oldData, $newData));
            } catch (\Exception $e) {
                \Log::error('Error al enviar notificación de actualización de perfil a ' . $usuario->email . ': ' . $e->getMessage());
                // Aquí podrías auditar el fallo de envío si lo necesitas
            }

            $message = 'Tu perfil ha sido actualizado exitosamente. Se ha enviado una notificación a tu correo electrónico.';
        }

        $responseData = [
            'nombre' => $validatedData['nombre'],
            'apellido' => $validatedData['apellido'],
            'message' => $message,
        ];

        return response()->json($responseData, Response::HTTP_ACCEPTED);

    }

   /* public function obtenerUsuario(string $email): JsonResponse */
/*        $usuario = User::where('email', $email)
                        ->with('usuarioEscuelas')
                        ->with('usuarioEscuelas.usuarioTipo')
                        ->first();

        if ($usuario) {
            return response()->json($usuario);
        } else {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        } */

   /*public function obtenerUsuario(Request $request): JsonResponse
   {

        $user = $request->user(); // El usuario autenticado a través del token
        */

       /* $usuario = User::where(['email', $user->email],
                               ['usuarioEscuela.id_escuela', $request->id_escuela])
        ->with('usuarioEscuelas')
        ->with('usuarioEscuelas.usuarioTipo')
        ->first();*/
       /* $usuario = User::where('email', $user->email)
                        ->whereHas('usuarioEscuelas', function ($query) use ($request) {
                            $query->where('id_escuela', $request->id_escuela);
                        })
                        ->with('usuarioEscuelas')
                        ->with('usuarioEscuelas.usuarioTipo')
                        ->first();

        if ($usuario) {
            return response()->json($usuario, 200);
        } else {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }
    }*/

    public function checkUser(string $email): JsonResponse
    {
        $usuario = Usuario::where('email', $email)->first();

        if ($usuario) {
            return response()->json(['mensaje' => 'Usuario encontrado'], 200);
        } else {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }
    }

    public function changeEmail(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email', Rule::unique('usuario')->ignore(auth()->user()->id, 'id')],
            'email_confirmation' => ['required', 'string', 'email', 'same:email'],
            'current_password' => ['required', 'current_password'],
        ]);

        $usuario = $request->user(); // El usuario autenticado a través del token
        // Verificar la contraseña actual
        if (!Hash::check($validatedData['current_password'], $usuario->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['La contraseña actual es incorrecta.'],
            ]);
        }

        $oldEmail = $usuario->email; // Guarda el correo electrónico antiguo antes de actualizarlo

        if ($usuario->email !== $validatedData['email']) {
            /* eliminar los timestamps de verificación del email */
            $usuario->email_verified_at = null;
            $usuario->verification_token = Str::random(60); // Genera un token aleatorio

            $usuario->email = $validatedData['email'];
            $usuario->save();

            // Eliminar todos los tokens existentes del usuario y los refresh tokens
            $usuario->tokens()->delete();
            RefreshToken::where('id_usuario', $usuario->id)
                ->delete();
            /* enviar email de verificación al nuevo correo */
            try {
                Mail::to($validatedData['email'])->send(new EmailVerificationMail($usuario));
                event(new EmailVerificationLinkSent($usuario, $validatedData['email'], 'email_change'));
            } catch (\Exception $e) {
                \Log::error('Error al enviar correo de verificación al nuevo email ' . $validatedData['email'] . ': ' . $e->getMessage());
                // Aquí podrías auditar el fallo de envío si lo necesitas
            }

            /* enviar email de notificación al correo antiguo */
            try {
                Mail::to($oldEmail)->send(new EmailChangedNotificationMail($usuario, $oldEmail, $validatedData['email'])); // Pasa los emails si tu Mailable los necesita
                event(new OldEmailNotificationSent($usuario, $oldEmail, $validatedData['email']));
            } catch (\Exception $e) {
                \Log::error('Error al enviar notificación a correo antiguo ' . $oldEmail . ': ' . $e->getMessage());
                // Aquí podrías auditar el fallo de envío si lo necesitas
            }

            $message = 'Tu dirección de correo electrónico ha sido actualizada. Se ha enviado un enlace de verificación al nuevo correo y un aviso al antiguo.';


        } else {
            // Si el email es el mismo, no hacemos nada con el email ni enviamos correos
            $message = 'La dirección de correo electrónico proporcionada es la misma que la actual. No se realizaron cambios.';
        }


        // La respuesta siempre incluirá el email actual del usuario
        $responseData = [
            'email' => $usuario->email, // Ahora $usuario->email ya está actualizado si hubo cambio
            'email_verified_at' => $usuario->email_verified_at,
            'message' => $message // Mensaje dinámico
        ];

        return response()->json($responseData, Response::HTTP_ACCEPTED);
    }

    public function changePassword(Request $request)
    {
        // modifica la password del usuario autenticado
        // se requiere la contraseña actual
        // y password nueva con confirmación
        $validatedData = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Password::defaults()],
        ]);
        $message = 'No se realizaron los cambios en tu contraseña.'; // Mensaje por defecto

        $usuario = $request->user(); // El usuario autenticado a través del token

        // Verificar la contraseña actual
        if (!Hash::check($validatedData['current_password'], $usuario->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['La contraseña actual es incorrecta.'],
            ]);
        }

        $usuario->password = Hash::make($validatedData['password']);
        $usuario->save();
        $message = 'Tu contraseña ha sido actualizada exitosamente. Se ha enviado una notificación a tu correo electrónico.';
        // Eliminar todos los tokens existentes del usuario y los refresh tokens
        $usuario->tokens()->delete();
        RefreshToken::where('id_usuario', $usuario->id)
                    ->delete();
        /* enviar email de verificación al nuevo correo */
        try {
            Mail::to($usuario->email)->send(new ProfileUpdatedPasswordNotificationMail($usuario));
                // 3. Auditar el envío de la notificación
            event(new ProfileUpdatedPasswordNotificationSent($usuario, $usuario->email));
        } catch (\Exception $e) {
            \Log::error('Error al enviar notificación de actualización de password a ' . $usuario->email . ': ' . $e->getMessage());
                // Aquí podrías auditar el fallo de envío si lo necesitas
        }

        $responseData = [
            'message' => $message,
        ];

        return response()->json($responseData, Response::HTTP_ACCEPTED);

    }
    public function userRefresh(Request $request) {
    // Función para refrescar la sesión del usuario auteticado.
    // devuelve el usuario, con la escuelas, y el tipo de acceso
    // Obtener el usuario autenticado directamente desde la solicitud.
        $usuario = $request->user();

        // Si el usuario no existe (aunque es improbable en una ruta protegida),
        // puedes retornar un error.
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no autenticado.'], 401);
        }

        // Cargar las relaciones directamente sobre el objeto de usuario.
        $usuario->load([
            'usuarioEscuelas.escuela',
            'usuarioEscuelas.usuarioTipo'
        ]);

        // Retornar la respuesta JSON.
        return response()->json($usuario, Response::HTTP_OK);
    }

}
