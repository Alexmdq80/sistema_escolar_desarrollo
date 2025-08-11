<?php

namespace App\Http\Controllers\Api\V1\Auth_VBA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\Usuario;
use Illuminate\Validation\Rules\Password as PasswordRule;

class ResetPasswordController extends Controller
{
    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                PasswordRule::defaults(),
            ],
        ]);

        $status = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($usuario) use ($request) {
                $usuario->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => null,
                ])->save();

                event(new PasswordReset($usuario));

                if (method_exists($usuario, 'tokens')) {
                    $usuario->tokens()->delete();
                }
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response()->json([
                'message' => 'Tu contraseña ha sido restablecida exitosamente.'
            ], Response::HTTP_OK);
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
