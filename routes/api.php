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
use App\Http\Controllers\Api\V1\ObtenerEscuela;

// MODELOS RELACIONADOS CON PERSONA
use App\Http\Controllers\Api\V1\DocumentoSituacionController;
//*********************************************************

use App\Http\Controllers\Api\V1\Auth_VBA\VbaLoginController;
use App\Http\Controllers\Api\V1\Auth_VBA\VbaLogoutController;
use App\Http\Controllers\Api\V1\Auth_VBA\VbaRegistroController;
use App\Http\Controllers\Api\V1\Auth_VBA\VbaPerfilController;
use App\Http\Controllers\Api\V1\Auth_VBA\ForgotPasswordController;
use App\Http\Controllers\Api\V1\Auth_VBA\ResetPasswordController;
use App\Http\Controllers\Api\V1\Auth_VBA\SolicitarColegio;

use App\Http\Controllers\Api\V1\Auth\EmailVerificationController;

use App\Models\Usuario; // Asegúrate de importar tu modelo Usuario
use Illuminate\Support\Facades\URL; // Para la firma de URL


/*Route::get('/debug-audit-config', function () {
    $auditConfig = Config::get('audit');
    dd($auditConfig);
});*/

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
// Route::middleware('auth:sanctum')->get('/usuario', function (Request $request) {
//     return $request->user();
// });
// Route::get('inscripciones/show-by-espacio', [InscripcionController::class,'showByEspacio']);
// Route::get('inscripciones/show-by-espacio', [InscripcionController::class,'showByEspacio']);
// Route::apiResource('inscripciones/show-by-espacio', [InscripcionController::class,'showByEspacio']);

    Route::get('/health', [HealthCheckController::class, 'check']);
        Route::group(['prefix' => 'tablas'], function () {
        Route::get('condicion/{anio}', [InscripcionController_VBA::class, 'obtenerCondiciones']);
        Route::get('espacio-academico/', [InscripcionController_VBA::class, 'obtenerEspaciosAcademicos']);
    });

    Route::post('/refresh-token', [VbaLoginController::class, 'refreshToken']);

  // Apunta al método 'verify' del nuevo controlador
    Route::get('/email/verify/{id}/{token}', [EmailVerificationController::class, 'verify'])->name('verification.verify');

    Route::group(['prefix' => 'auth-VBA'], function () {
        // Ruta para solicitar el enlace de restablecimiento de contraseña
        Route::post('password/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail'])
            ->middleware('throttle:forgot-password') // Aplicar throttling para prevenir abusos
            ->name('password.forgot');
        // Ruta para restablecer la contraseña
        // Esta ruta no necesita throttling aquí, ya que el token es de un solo uso y limitado en el tiempo.
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])
            ->name('password.reset');
    });



    Route::middleware('auth:sanctum')->group(function () {
        // Listado de inscripciones, luego pasar al middleware auth:sanctum
        Route::get('/inscripciones', [InscripcionController_VBA::class, 'index']);
        Route::get('/personas', [PersonaController::class, 'index']);
        // Route::apiResource('/personas/documento-situaciones', DocumentoSituacionController::class);
        
        Route::get('/personas/referencias', [ReferenceDataController::class, 'index']);
        
        
        Route::post('/user/resend-verification', [EmailVerificationController::class, 'resendAuthenticated'])
            ->name('verification.resend.authenticated')
            ->middleware('throttle:resend-verification'); // Limita el reenvío de verificación
            //->middleware('throttle:3,30');

        Route::group(['prefix' => 'escuelas'], function () {
            Route::get('escuela-por-cue/{cueAnexo}', [ObtenerEscuela::class, 'escuelaPorCue']);
        });

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
            Route::put('vbaPerfilChangeEmail', [VbaPerfilController::class, 'changeEmail'])
                    ->middleware('throttle:change-email'); // Limita el cambio de email
            //  ->middleware('throttle:5,60');
            Route::put('vbaPerfilChangePassword', [VbaPerfilController::class, 'changePassword'])
                    ->middleware('throttle:change-password'); // Limita el cambio de contraseña

           // Route::get('usuario_actual/{id_escuela}', [VbaPerfilController::class, 'obtenerUsuario']);
            Route::post('logout', [VbaLogoutController::class, 'logout']);
            Route::post('solicitar-colegio', [SolicitarColegio::class, 'solicitarColegio']);
            Route::get('user-refresh', [VbaPerfilController::class, 'userRefresh']);
        });
    });

    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', AngularLoginController::class)->name('login');
        Route::post('registro', AngularRegistroController::class)->name('registro');
    });

    Route::group(['prefix' => 'auth-VBA'], function () {
        Route::post('vbaLogin', VbaLoginController::class)->name('vbaLogin');
        Route::post('vbaRegistro', VbaRegistroController::class)->name('vbaRegistro');
        Route::get('/check-user/{email}', [VbaPerfilController::class, 'checkUser']);
    });
