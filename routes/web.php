<?php

use Illuminate\Support\Facades\Route;
use App\Models\Persona;
use App\Models\Sexo;
use App\Models\Documento_Tipo;
use App\Models\Escuela;
use App\Models\Nivel;
use App\Models\Usuario;
use App\Models\Localidad_Censal;
use App\Models\Calle;
/*

|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('prueba', function() {

    // $escuela = Escuela::find(1);

    // return $escuela->nivel;

    // DB::enableQueryLog();

    // $nivel = Nivel::find(1);
    
    // $escuelas = $nivel->escuela;

    // dd(DB::getQueryLog());

    // return $escuelas;

    // $escuela = Escuela::find(10109);

    // return [$escuela->localidad_asentamiento,
    //         $escuela->departamento,
    //         $escuela->provincia,
    //         $escuela->pais,
    //         $escuela->continente,
    //         $escuela->ambito, 
    //         $escuela->dependencia,
    //         $escuela->sector];
    // $persona = Persona::find(3);
    // return [
    //         $persona,
    //         $persona->documento_tipo,
    //         $persona->documento_situacion,
    //         $persona->sexo,
    //         $persona->genero,
    //         $persona->nacionalidad,
    //         $persona->nacimiento_pais,
    //         $persona->nacimiento_provincia,
    //         $persona->nacimiento_departamento,
    //         $persona->nacimiento_localidad_asentamiento
    // ];
    $calle = Calle::find(246);
    return $calle->continente;

});