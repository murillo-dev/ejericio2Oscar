<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Zona;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        echo "Iniciando seeding...\n";
        echo "Creando zonas...\n";

        Zona::insert([
            ['nombre' => 'Zona 1', 'descripcion' => 'Primera zona', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Zona 2', 'descripcion' => 'Segunda zona', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Zona 3', 'descripcion' => 'Tercera zona', 'created_at' => now(), 'updated_at' => now()],
        ]);

        echo "¡Seeding completado!\n";
    }
}
