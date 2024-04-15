<?php

namespace Database\Seeders;

use App\Models\Categoria_Georef;
use Illuminate\Database\Seeder;

class Categoria_GeorefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = Categoria_Georef::count();

        if (!$registros) {

            $categoria = new Categoria_Georef();

            $categoria->id = 1;
            $categoria->nombre = "SITIO EDIFICADO";
            $categoria->orden = 10;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 2;
            $categoria->nombre = "LOCALIDAD SIMPLE";
            $categoria->orden = 15;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 3;
            $categoria->nombre = "COMPONENTE DE LOCALIDAD COMPUESTA";
            $categoria->orden = 20;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 4;
            $categoria->nombre = "ENTIDAD";
            $categoria->orden = 25;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 5;
            $categoria->nombre = "LOCALIDAD SIMPLE CON ENTIDAD";
            $categoria->orden = 30;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 6;
            $categoria->nombre = "COMPONENTE DE LOCALIDAD COMPUESTA CON ENTIDAD";
            $categoria->orden = 35;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 7;
            $categoria->nombre = "MUNICIPIO";
            $categoria->orden = 40;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 8;
            $categoria->nombre = "COMISIÓN MUNICIPAL";
            $categoria->orden = 45;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 9;
            $categoria->nombre = "COMISIÓN DE FOMENTO";
            $categoria->orden = 50;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 10;
            $categoria->nombre = "COMUNA";
            $categoria->orden = 55;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 11;
            $categoria->nombre = "DELEGACIÓN MUNICIPAL";
            $categoria->orden = 60;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 12;
            $categoria->nombre = "COMUNA RURAL";
            $categoria->orden = 65;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 13;
            $categoria->nombre = "JUNTA VECINAL";
            $categoria->orden = 70;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 14;
            $categoria->nombre = "PARTIDO";
            $categoria->orden = 75;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 15;
            $categoria->nombre = "DEPARTAMENTO";
            $categoria->orden = 80;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 16;
            $categoria->nombre = "PROVINCIA";
            $categoria->orden = 85;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 17;
            $categoria->nombre = "CIUDAD AUTÓNOMA";
            $categoria->orden = 90;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 18;
            $categoria->nombre = "CALLE";
            $categoria->orden = 95;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 19;
            $categoria->nombre = "AV";
            $categoria->orden = 96;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 20;
            $categoria->nombre = "PJE";
            $categoria->orden = 97;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 21;
            $categoria->nombre = "RUTA";
            $categoria->orden = 98;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 22;
            $categoria->nombre = "AUT";
            $categoria->orden = 99;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 23;
            $categoria->nombre = "CJON";
            $categoria->orden = 100;
            $categoria->vigente = true;

            $categoria->save();

            $categoria = new Categoria_Georef();

            $categoria->id = 24;
            $categoria->nombre = "BV";
            $categoria->orden = 101;
            $categoria->vigente = true;

            $categoria->save();
        }
       //
    }
}
