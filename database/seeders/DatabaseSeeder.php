<?php

namespace Database\Seeders;

use App\Models\Konsentrasi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            QuestionSeeder::class,
            OptionsSeeder::class,
            JurusanSeeder::class,
            MataKuliahSeeder::class,
            KonsentrasiSeeder::class,
        ]);
    }
}
