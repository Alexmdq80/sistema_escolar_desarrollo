<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AngularLoginController;
use App\Http\Controllers\Api\V1\Auth\AngularLogoutController;
use App\Http\Controllers\Api\V1\Auth\AngularRegistroController;
use App\Http\Controllers\Api\V1\Auth\AngularPerfilController;

use App\Http\Controllers\Api\V1\PersonaController;
use App\Http\Controllers\Api\V1\InscripcionController;
use App\Http\Controllers\Api\V1\InscripcionController_VBA;
use App\Http\Controllers\Api\V1\HealthCheckController;

use App\Http\Controllers\Api\V1\Auth_VBA\VbaLoginController;
use App\Http\Controllers\Api\V1\Auth_VBA\VbaLogoutController;
use App\Http\Controllers\Api\V1\Auth_VBA\VbaRegistroController;
use App\Http\Controllers\Api\V1\Auth_VBA\VbaPerfilController;

use App\Models\User; // Asegúrate de importar tu modelo User
use Illuminate\Support\Facades\URL; // Para la firma de URL

// use Illuminate\Validation\ValidationException;
/*

|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



// Route::get('inscripciones/show-by-espacio', [InscripcionController::class,'showByEspacio']);

// Route::get('inscripciones/show-by-espacio', [InscripcionController::class,'showByEspacio']);
// Route::apiResource('inscripciones/show-by-espacio', [InscripcionController::class,'showByEspacio']);


/* Route::post('/test-error', function () {
    throw ValidationException::withMessages([
        'test' => ['Este es un error de prueba.'],
    ]);
});*/



Route::get('/health', [HealthCheckController::class, 'check']);
Route::group(['prefix' => 'tablas'], function () {
    Route::get('condicion/{anio}', [InscripcionController_VBA::class, 'obtenerCondiciones']);
    Route::get('espacio-academico/', [InscripcionController_VBA::class, 'obtenerEspaciosAcademicos']);
});

// Opcional: Ruta para reenviar el correo (si la necesitas)
Route::post('/email/resend-manual', function (Request $request) {
    // ... tu lógica para reenviar el correo ...
})->name('verification.resend.manual');

Route::get('/email/verify/{id}/{token}', function (Request $request, $id, $token) {
    // 1. Buscar al usuario por ID
    $user = User::find($id);

    // 2. Verificar si el usuario existe
    if (!$user) {
        // Podrías redirigir a una página de error o simplemente responder con JSON
        return response()->json(['message' => 'Enlace de verificación inválido o usuario no encontrado.'], 404);
    }

    // 3. Verificar si el correo ya está verificado
    if ($user->email_verified_at !== null) {
        return response()->json(['message' => 'Tu correo electrónico ya ha sido verificado.'], 200);
    }

    // 4. Verificar el token.
    // Es crucial que el token del enlace coincida con el almacenado en la DB
    if ($user->verification_token !== $token) {
        return response()->json(['message' => 'Token de verificación inválido.'], 400);
    }

    // 5. Opcional: Verificar la expiración del enlace firmado por Laravel
    // Esto es muy importante para la seguridad. URL::hasValidSignature() usa el tiempo que le diste en el Mailable (60 mins)
    // y el ID del usuario.
    // Asegúrate de que la URL que el usuario copia incluye el parámetro 'signature'.
    // Si la ruta en el Mailable se generó con URL::temporarySignedRoute, esta verificación es vital.
    if (! URL::hasValidSignature($request)) {
        return response()->json(['message' => 'El enlace de verificación ha expirado o es inválido (firma no válida).'], 400);
    }

    // 6. Si todas las verificaciones pasan, marcar el correo como verificado
    $user->email_verified_at = now();
    $user->verification_token = null; // Opcional: Limpiar el token después de usarlo (es buena práctica)
    $user->save(); // Guardar los cambios en la base de datos

    // 7. Responder al usuario
    return response()->json(['message' => '¡Felicidades! Tu correo electrónico ha sido verificado con éxito.'], 200);

})->name('verification.verify');

Route::middleware('auth:sanctum')->group(function () {
   Route::group(['prefix' => 'estudiante'], function () {
       Route::get('legajo', [InscripcionController_VBA::class, 'obtenerLegajo']);
   });

   Route::group(['prefix' => 'vba'], function () {
       Route::get('inscripciones/{id}', [InscripcionController_VBA::class, 'obtenerInscripcion']);
       Route::put('inscripciones-historial/corregir-condicion', [InscripcionController_VBA::class, 'corregirHistorialCondicion']);
   });

   Route::group(['prefix' => 'angular'], function () {
       Route::apiResource('inscripciones', InscripcionController::class);
       Route::apiResource('personas', PersonaController::class);
   });

   Route::group(['prefix' => 'auth-Angular'], function () {
        Route::get('perfil', [AngularPerfilController::class, 'show']);
        Route::put('perfil', [AngularPerfilController::class, 'update']);
        Route::post('logout', AngularLogoutController::class);
   });

   Route::group(['prefix' => 'auth-VBA'], function () {
        Route::put('vbaPerfil', [VbaPerfilController::class, 'update']);
        Route::get('usuario_actual/{id_escuela}', [VbaPerfilController::class, 'obtenerUsuario']);
        Route::post('logout', [VbaLogoutController::class, 'logout']);
   });
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('auth/login', AngularLoginController::class)->name('login');
    Route::post('auth/registro', AngularRegistroController::class)->name('registro');
});

Route::group(['prefix' => 'auth-VBA'], function () {
    Route::post('vbaLogin', VbaLoginController::class)->name('vbaLogin');
    Route::post('vbaRegistro', VbaRegistroController::class)->name('vbaRegistro');
    Route::get('/check-user/{email}', [VbaPerfilController::class, 'checkUser']);
});

 // Route::post('alquileres/inicio', [AlquilerController::class, 'inicio']);
    // Route::put('alquileres/finalizar/{alquiler}', [AlquilerController::class, 'finalizar']);
    // Route::get('alquileres', [AlquilerController::class, 'index']);

    // Rutas que no requieren el middleware "es_admin"

    // // Rutas que requieren el middleware "es_admin"
    // Route::apiResource('bicicletas', BicicletaController::class)->except(['index', 'show'])->middleware('es_admin');

