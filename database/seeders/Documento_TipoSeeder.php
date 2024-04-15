<?php

namespace Database\Seeders;

use App\Models\Documento_Tipo;
use Illuminate\Database\Seeder;

class Documento_TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $registros = Documento_Tipo::count();

        if (!$registros) {

            $doc_t = new Documento_Tipo();

            $doc_t->id = 1;
            $doc_t->nombre = "DNI";
            $doc_t->orden = 10;
            $doc_t->vigente = true;

            $doc_t->save();

            $doc_t = new Documento_Tipo();

            $doc_t->id = 2;
            $doc_t->nombre = "CDI";
            $doc_t->orden = 20;
            $doc_t->vigente = true;

            $doc_t->save();

            $doc_t = new Documento_Tipo();

            $doc_t->id = 3;
            $doc_t->nombre = "LC";
            $doc_t->orden = 30;
            $doc_t->vigente = true;

            $doc_t->save();

            $doc_t = new Documento_Tipo();

            $doc_t->id = 4;
            $doc_t->nombre = "PASAPORTE";
            $doc_t->orden = 40;
            $doc_t->vigente = true;

            $doc_t->save();

            $doc_t = new Documento_Tipo();

            $doc_t->id = 5;
            $doc_t->nombre = "OTRO";
            $doc_t->orden = 50;
            $doc_t->vigente = true;

            $doc_t->save();
        //
        }
    }
}
