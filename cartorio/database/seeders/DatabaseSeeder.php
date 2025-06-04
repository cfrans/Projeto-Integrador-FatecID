<?php

namespace Database\Seeders;

use App\Models\Usuario;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(\Database\Seeders\DadosBasicosSeeder::class);
        // User::factory(10)->create();

        Usuario::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
