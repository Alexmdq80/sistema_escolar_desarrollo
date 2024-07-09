<?php

namespace Database\Seeders;

use App\Models\Persona;
// use App\Models\Sexo;
use App\Models\Genero;
use App\Models\Pais;
// use App\Models\Documento_Tipo;
// use App\Models\Documento_Situacion;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected static int $n_personas;
    protected static int $n_noBinarios;
    protected static int $n_transGenero;
    protected static int $n_noArgentinos;
    protected static int $n_argNacidosExterior;
    protected static int $n_menores;
    protected static int $n_fallecidos;
    protected static int $n_sinDNI;
    protected static int $n_sinDNIsinDocExt;
    protected static int $n_conCPI;
    protected static $id_paises;
    // protected static $sexos;
    protected static $id_generos;
    protected static bool $solo_menores;
    // protected static $documento_tipos;
    // protected static $documento_situaciones;

    public static function set_solo_menores(bool $valor): void
    {
        self::$solo_menores = $valor;
    }
    public static function get_solo_menores(): bool
    {
        return self::$solo_menores;
    }

    public static function set_n_personas(int $valor): void
    {
        self::$n_personas = $valor;
    }
    public static function get_n_personas(): int
    {
        return self::$n_personas;
    }
    public static function set_n_noBinarios(int $valor): void
    {
        self::$n_noBinarios = $valor;
    }
    public static function get_n_noBinarios(): int
    {
        return self::$n_noBinarios;
    }
    public static function set_n_transGenero(int $valor): void
    {
        self::$n_transGenero = $valor;
    }
    public static function get_n_transGenero(): int
    {
        return self::$n_transGenero;
    }
    public static function set_n_noArgentinos(int $valor): void
    {
        self::$n_noArgentinos = $valor;
    }
    public static function get_n_noArgentinos(): int
    {
        return self::$n_noArgentinos;
    }
    public static function set_n_argNacidosExterior(int $valor): void
    {
        self::$n_argNacidosExterior = $valor;
    }
    public static function get_n_argNacidosExterior(): int
    {
        return self::$n_argNacidosExterior;
    }
    public static function set_n_menores(int $valor): void
    {
        self::$n_menores = $valor;
    }
    public static function get_n_menores(): int
    {
        return self::$n_menores;
    }
    public static function set_n_fallecidos(int $valor): void
    {
        self::$n_fallecidos = $valor;
    }
    public static function get_n_fallecidos(): int
    {
        return self::$n_fallecidos;
    }
    public static function set_n_sinDNI(int $valor): void
    {
        self::$n_sinDNI = $valor;
    }
    public static function get_n_sinDNI(): int
    {
        return self::$n_sinDNI;
    }
    public static function set_n_sinDNIsinDocExt(int $valor): void
    {
        self::$n_sinDNIsinDocExt = $valor;
    }
    public static function get_n_sinDNIsinDocExt(): int
    {
        return self::$n_sinDNIsinDocExt;
    }
    public static function set_n_conCPI(int $valor): void
    {
        self::$n_conCPI = $valor;
    }
    public static function get_n_conCPI(): int
    {
        return self::$n_conCPI;
    }
    public static function set_id_paises($valor): void
    {
        self::$id_paises = $valor;
    }
    public static function get_id_paises()
    {
        return self::$id_paises;
    }
    // public static function set_sexos( $valor): void
    // {
    //     self::$sexos = $valor;
    // }
    // public static function get_sexos()
    // {
    //     return self::$sexos;
    // }
    public static function set_id_generos($valor): void
    {
        self::$id_generos = $valor;
    }
    public static function get_id_generos()
    {
        return self::$id_generos;
    }
    // public static function set_documento_tipos( $valor): void
    // {
    //     self::$documento_tipos = $valor;
    // }
    // public static function get_documento_tipos()
    // {
    //     return self::$documento_tipos;
    // }
    // public static function set_documento_situaciones( $valor): void
    // {
    //     self::$documento_situaciones = $valor;
    // }
    // public static function get_documento_situaciones()
    // {
    //     return self::$documento_situaciones;
    // }

    public function run(): void
    {

        $persona = new Persona();

        $existe = $persona->where('documento_numero', 32126643)
                          ->where('id_documento_tipo', 1)
                          ->count();
        if (!$existe) {
            $persona->id_documento_tipo = 1;
            $persona->id_documento_situacion = 1;
            $persona->id_sexo = 1;
            $persona->id_genero = 2;
            $persona->nacionalidad_id_pais = 158;
            $persona->nacimiento_lugar_id_pais = 165;
            $persona->documento_numero = 32126643;
            $persona->apellido = 'ACTIS LOBOS';
            $persona->nombre = 'ALEX JAVIER';
            $persona->vive_si = true;
            $persona->cuil_prefijo = 20;
            $persona->cuil_sufijo = 7;
            $persona->nacimiento_fecha = Carbon::parse('1980-05-21');

            $persona->save();
        }
// INICIALIZAR LOS CONTADORES -
// n_personas TOTAL DE PERSONAS
// n_noBinarios TOTAL DE SEXO X
// n_transGenero TOTAL DE PERSONAS QUE NO COINCIDE EL SEXO CON EL GÉNERO
// n_noArgentinos TOTAL DE PERSONAS EXTRANJERAS PAIS <> 158
// n_argNacidosExterior TOTAL DE PERSONAS NACIONALIDAS ARGENTINAS NACIDAS EN EL EXTERIOR
// n_menores TOTAL DE PERSONAS MENORES DE 19 AÑOS (NACIDAS DESPUES DEL 2005)
// n_fallecidos TOTAL DE PERSONAS FALLECIDAS
// n_sinDNI TOTAL DE PERSONAS SIN DNI
// n_sinDNIsinDocExt TOTAL DE PERSONAS SIN NINGÚN DOCUMENTO
// n_conCPI TOTAL DE PERSONAS CON CPI, TENDRÍAN QUE SER PERSONAS QUE NO TIENEN NINGÚN DOCUMENTO
        if (!$existe) {
            self::set_n_personas(Persona::count());
            self::set_n_noBinarios(Persona::where('id_sexo', 3)->count());
            self::set_n_transGenero(Persona::where([
                                                                ['id_sexo', 1],
                                                                ['id_genero', '<>', 2]
                                                            ])->orWhere([
                                                                ['id_sexo', 2],
                                                                ['id_genero', '<>', 1]
                                                            ])->count());

            self::set_n_noArgentinos(Persona::where('nacionalidad_id_pais', '<>', 158)->count());
            self::set_n_argNacidosExterior(Persona::where([
                                                                ['nacionalidad_id_pais','=', 158],
                                                                ['nacimiento_lugar_id_pais', '<>', 158]
                                                            ])->count());

            $n_personas_menores = Persona::where('nacimiento_fecha','>','2005-01-01')->count();
            if ($n_personas_menores == NULL) {
            self::set_n_menores(0);
            } else {
            self::set_n_menores($n_personas_menores);
            }
            // PersonaSeeder::set_n_menores(Persona::where('nacimiento_fecha'),'>','2005-01-01')->count();

            self::set_n_fallecidos(Persona::where('vive_si', 0)->count());

            self::set_n_sinDNI(Persona::where('id_documento_tipo','<>', 1)->count());

            self::set_n_sinDNIsinDocExt(Persona::where([
                                                                    ['id_documento_tipo','<>', 1],
                                                                    ['posee_docExt_si', 0]
                                                                ])->count());

            self::set_n_conCPI(Persona::where('posee_cpi_si','<>', 0)->count());

            // print_r(PersonaSeeder::get_n_personas());

            // $paises = Pais::get(['id'])->pluck('id');
            $paises = Pais::get(['id']);

            self::set_id_paises($paises);

            // self::set_sexos(Sexo::get(['id']));

            // $generos = Genero::get(['id'])->pluck('id');
            $generos = Genero::get(['id']);

            self::set_id_generos($generos);

            // var_dump(self::get_paises());

            // self::set_documento_tipos(Documento_Tipo::get(['id']));
            // self::set_documento_situaciones(Documento_Situacion::get(['id']));

            // $prueba = (object) [
            //             'id' => '12345679'
            //             ];

            // echo "$prueba->id";
    // PONER EN FALSE SI SE QUIERE HACER MENORES Y MAYORES
    
            self::set_solo_menores(false);

            Persona::factory(15000)->create();
            //
        }
    }
}