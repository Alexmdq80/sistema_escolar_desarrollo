<?php

namespace Database\Seeders;

use App\Models\Fuente_Georef;
use Illuminate\Database\Seeder;

class Fuente_GeorefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = Fuente_Georef::count();

        if (!$registros) {

            $fuente = new Fuente_Georef();

            $fuente->id = 1;
            $fuente->nombre = "IGN";
            $fuente->orden = 10;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 2;
            $fuente->nombre = strtoupper("Direc. Grl. de Inmuebles");
            $fuente->orden = 15;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 3;
            $fuente->nombre = strtoupper("ARBA - Gerencia de Servicios Catastrales");
            $fuente->orden = 20;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 4;
            $fuente->nombre = strtoupper("Adm. Grl. de Catastro");
            $fuente->orden = 25;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 5;
            $fuente->nombre = strtoupper("Direc. de Geodesia y Catastro");
            $fuente->orden = 30;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 6;
            $fuente->nombre = strtoupper("Direc. Pcial. de Catastro e Inf. Territorial");
            $fuente->orden = 35;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 7;
            $fuente->nombre = strtoupper("Dirección de Estadística de la Prov. Tucumán");
            $fuente->orden = 40;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 8;
            $fuente->nombre = strtoupper("Direc. Pcial. de Catastro y Cartografía");
            $fuente->orden = 45;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 9;
            $fuente->nombre = strtoupper("Ministerio de Ecología");
            $fuente->orden = 50;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 10;
            $fuente->nombre = strtoupper("Direc. Grl. Catastro (WMS)");
            $fuente->orden = 55;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 11;
            $fuente->nombre = strtoupper("Dirección de Estadística y Censos");
            $fuente->orden = 60;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 12;
            $fuente->nombre = strtoupper("Servicio de Catastro e Información Territorial");
            $fuente->orden = 65;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 13;
            $fuente->nombre = strtoupper("Dirección de Geodesia y Catastro");
            $fuente->orden = 70;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 14;
            $fuente->nombre = strtoupper("Dirección General de Estadística y Censos");
            $fuente->orden = 75;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 15;
            $fuente->nombre = strtoupper("Direc. Grl. de Catastro");
            $fuente->orden = 75;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 16;
            $fuente->nombre = strtoupper("A.R.T - Gerencia de Catastro");
            $fuente->orden = 80;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 17;
            $fuente->nombre = strtoupper("AREF");
            $fuente->orden = 85;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 18;
            $fuente->nombre = strtoupper("Direc. de Catastro");
            $fuente->orden = 90;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 19;
            $fuente->nombre = strtoupper("ATER - Direc. de Catastro");
            $fuente->orden = 95;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 20;
            $fuente->nombre = strtoupper("Gerencia de Catastro Pcial.");
            $fuente->orden = 100;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 21;
            $fuente->nombre = strtoupper("SCAR");
            $fuente->orden = 105;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 22;
            $fuente->nombre = strtoupper("GPS-EDUCACION");
            $fuente->orden = 110;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 23;
            $fuente->nombre = strtoupper("APROXIMADA-EDUCACION");
            $fuente->orden = 115;
            $fuente->vigente = true;

            $fuente->save();

            $fuente = new Fuente_Georef();

            $fuente->id = 24;
            $fuente->nombre = strtoupper("INDEC");
            $fuente->orden = 120;
            $fuente->vigente = true;

            $fuente->save();


        }

    }

}
