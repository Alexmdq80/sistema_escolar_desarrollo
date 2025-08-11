<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Documento_Tipo;
use App\Models\Persona;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

/*         \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'myPassword'
         ]);
 */
        $this->call(AmbitoSeeder::class);

        $this->call(TurnoSeeder::class);

        $this->call(JornadaSeeder::class);

        $this->call(Seccion_TipoSeeder::class);

        $this->call(DependenciaSeeder::class);

        $this->call(SectorSeeder::class);

        $this->call(NivelSeeder::class);

        $this->call(ModalidadSeeder::class);

        $this->call(CondicionSeeder::class);

        $this->call(Documento_TipoSeeder::class);

        $this->call(Documento_SituacionSeeder::class);

        $this->call(GeneroSeeder::class);

        $this->call(SexoSeeder::class);

        $this->call(Vinculo_TipoSeeder::class);

        $this->call(Adulto_VinculoSeeder::class);

        // $this->call(PersonaSeeder::class);

        $this->call(UsuarioSeeder::class);

        $this->call(UsuarioEscuelaSeeder::class);

        // $this->call(Categoria_GeorefSeeder::class);

        $this->call(Ciclo_LectivoSeeder::class);

        $this->call(Otras_OfertasSeeder::class);

        $this->call(Ciclo_Plan_EstudioSeeder::class);

        $this->call(Plan_EstudioSeeder::class);

        $this->call(AnioSeeder::class);

        $this->call(Anio_PlanSeeder::class);

        $this->call(Propuesta_InstitucionalSeeder::class);

        $this->call(Escuela_PISeeder::class);

        $this->call(Espacio_AcademicoSeeder::class);

        // $this->call(Espacio_AcademicoSeeder::class);

        // $this->call(Estudiante_Adulto_VinculoSeeder::class);

        // $this->call(DomicilioSeeder::class);

        // $this->call(ContactoSeeder::class);

        // $this->call(InscripcionSeeder::class);

        // $this->call(LegajoSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
